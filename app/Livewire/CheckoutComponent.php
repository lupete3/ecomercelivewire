<?php

namespace App\Livewire;

use App\Jobs\OrderConfirmedJob;
use App\Mail\OrderConfirmedMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\Attributes\On;

class CheckoutComponent extends Component
{
    public $adress_type;
    public $name;
    public $phone;
    public $email;
    public $city;
    public $adress;

    public $idShippingAdress;

    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

    public $shippingCost= 0;
    public $additional_onfo;
    public $paymentType;

    public $thankyou;

    protected $listeners = ['deleteConfirmed', 'refreshComponent' => '$refresh'];


    public function showAddShippingModal()
    {
        $this->dispatch('openAddShippingModal');
    }

    public function showEditShippingModal($idShippingAdress)
    {
        $shippingAdress = Shipping::where('id', $idShippingAdress)->first();

        $this->idShippingAdress = $idShippingAdress;
        $this->adress_type = $shippingAdress->adress_type;
        $this->name = $shippingAdress->name;
        $this->phone = $shippingAdress->phone;
        $this->email = $shippingAdress->email;
        $this->city = $shippingAdress->city;
        $this->adress = $shippingAdress->adress;

        $this->dispatch('openEditShippingModal');
    }

    public function editShippingAdress($idShippingAdress)
    {
        $shippingAdress = Shipping::where('id', $idShippingAdress)->first();

        $this->idShippingAdress = $idShippingAdress;
        $this->adress_type = $shippingAdress->adress_type;
        $this->name = $shippingAdress->name;
        $this->phone = $shippingAdress->phone;
        $this->email = $shippingAdress->email;
        $this->city = $shippingAdress->city;
        $this->adress = $shippingAdress->adress;
    }


    public function updateShipping()
    {
        $this->validate([
            'adress_type' => 'required',
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'nullable|email',
            'city' => 'required|string',
            'adress' => 'required',
        ],[
            'adress_type.required' => 'Choisir le type d\'adresse',
            'name.required' => 'Etrez votre nom',
            'phone.required' => 'Etrez votre numéro de téléphone',
            'email.required' => 'Etrez une adresse mail valide',
            'city.required' => 'Choisir votre ville',
            'adress.required' => 'Entrez votre adresse de livraison',
        ]);

        $shipping = Shipping::where('id', $this->idShippingAdress)->first();

        $shipping->adress_type = $this->adress_type;
        $shipping->name = $this->name;
        $shipping->phone = $this->phone;
        $shipping->email = $this->email;
        $shipping->city = $this->city;
        $shipping->adress = $this->adress;

        $shipping->save();

        $this->dispatch('hideEditShippingModal');
        $this->reset();

        flash()->success('Adresse de livraison a été modifiée.');
    }

    public function addShipping()
    {
        $this->validate([
            'adress_type' => 'required',
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'nullable|email',
            'city' => 'required|string',
            'adress' => 'required',
        ],[
            'adress_type.required' => 'Choisir le type d\'adresse',
            'name.required' => 'Etrez votre nom',
            'phone.required' => 'Etrez votre numéro de téléphone',
            'email.required' => 'Etrez une adresse mail valide',
            'city.required' => 'Choisir votre ville',
            'adress.required' => 'Entrez votre adresse de livraison',
        ]);

        $shipping = new Shipping();

        $shipping->user_id = Auth::id();
        $shipping->adress_type = $this->adress_type;
        $shipping->name = $this->name;
        $shipping->phone = $this->phone;
        $shipping->email = $this->email;
        $shipping->city = $this->city;
        $shipping->adress = $this->adress;

        $shipping->save();

        $this->dispatch('hideAddShippingModal');
        $this->reset();

        flash()->success('Adresse de livraison ajoutée.');

    }

    public function sendConfirm($idShippingAdress, $type, $message, $title)
    {
        $this->idShippingAdress = $idShippingAdress;

        $this->dispatch('clientConfirm',
            type: $type,
            title: $title,
            message: $message,
            id: $this->idShippingAdress,
            action: 'adressAction'
        );

    }

    #[On('adressAction')]
    public function deleteShippingAdress($id)
    {
        $this->idShippingAdress = $id;

        $this->dispatch('confirmDeleteShippingAdress');

        $shippingAdress = Shipping::find($this->idShippingAdress)->delete();

        flash()->success('Adresse de livraison supprimée.');

    }

    #[On('makeActionCancel')]
    public function clientCancelAction ($id)
    {
        return;
    }

    public function calculateDiscount()
    {
        if (session()->has('coupon')) {
            if (session()->get('coupon')['coupon_type'] == 'fixed') {
                $this->discount = session()->get('coupon')['coupon_value'];
            }else{
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['coupon_value']) / 100;
            }

            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;

            $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax')) / 100;

            $this->totalAfterDiscount = $this->taxAfterDiscount + $this->subtotalAfterDiscount;
        }
    }

    public function placeOrder()
    {
        $shipping = Shipping::where('user_id', Auth::id())->where('adress_type', $this->adress_type)->first();

        if($shipping){

            $this->validate([
                'paymentType' => 'required',
            ],[
                'paymentType.required' => 'Vueillez choisir un mode de paiement'
            ]);

            $order = new Order();

            $order->user_id = Auth::id();
            $order->subtotal = session()->get('checkout')['subtotal'];
            $order->discount = session()->get('checkout')['discount'];
            $order->tax = session()->get('checkout')['tax'];;
            $order->shipping_cost = $this->shippingCost;
            $order->total = session()->get('checkout')['total'] + $this->shippingCost;
            $order->name = $shipping->name;
            $order->phone = $shipping->phone;
            $order->email = $shipping->email;
            $order->city = $shipping->city;
            $order->adress = $shipping->adress;
            $order->additional_information = $this->additional_onfo;
            $order->status = "ordered";

            $order->save();

            foreach (Cart::instance('cart')->content() as $cart) {
                $orderItem = new OrderItem;

                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cart->model->id;
                $orderItem->price = $cart->price;
                $orderItem->quantity = $cart->qty;

                if ($cart->options) {
                    $orderItem->options = serialize($cart->options);
                }

                Product::find($cart->id)->decrement('quantity', $cart->qty);

                $orderItem->save();
            }

            $transaction = new Transaction();

            $transaction->user_id = Auth::id();
            $transaction->order_id = $order->id;
            $transaction->payment_type = $this->paymentType ? $this->paymentType : 'cash';
            $transaction->status = 'pending';

            $transaction->save();

            flash()->success('Commande envoyees avec success.');

            $this->thankyou = 1;

            Cart::instance('cart')->destroy();

            session()->forget('checkout');

            OrderConfirmedJob::dispatch($order);

        }else{

            flash()->info('Vueillez choisir une Adresse de livraison.');

        }
    }

    public function applyShippingAdress($city)
    {
        if ($city == 'Bukavu') {
            $this->shippingCost = 2;
        }elseif($city == 'Goma') {
            $this->shippingCost = 4;
        }elseif($city == 'Kamituga') {
            $this->shippingCost = 7;
        }elseif($city == 'Uvira') {
            $this->shippingCost = 5;
        }elseif($city == 'Lubumbashi') {
            $this->shippingCost = 5;
        }


    }

    public function verifyCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }elseif ($this->thankyou) {
            return redirect()->route('thankyou');
        }elseif (!session()->get('checkout')) {
            return redirect()->route('cart');
        }elseif (!Cart::instance('cart')->count() > 0) {
            return redirect()->route('shop');
        }
    }

    public function render()
    {
        if (session()->has('coupon')) {
            if (Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']) {
                session()->forget('coupon');
            } else {
                $this->calculateDiscount();
            }

        }

        $this->verifyCheckout();

        $shippingAdresses = Shipping::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('livewire.checkout-component', ['shippingAdresses' => $shippingAdresses]);
    }
}
