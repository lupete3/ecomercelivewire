<?php

namespace App\Livewire;

use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class CartComponent extends Component
{
    public $couponCode = '';

    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;


    public function addQuantityToCart($cartId)
    {
        $cart = Cart::instance('cart')->get($cartId);
        if ($cart->model->quantity > $cart->qty) {
            $nouvelleQuantite = $cart->qty + 1;
        }else{
            $nouvelleQuantite = $cart->model->quantity;
            flash()->info('Cette quantité n\'est pas dispobible ! il reste '.$cart->model->quantity.' en stock');
        }
        Cart::instance('cart')->update($cartId, $nouvelleQuantite);
        $this->dispatch('refreshComponent');
    }

    public function reduceQuantityToCart($cartId)
    {
        $cart = Cart::instance('cart')->get($cartId);
        $nouvelleQuantite = $cart->qty - 1;
        Cart::instance('cart')->update($cartId, $nouvelleQuantite);
        $this->dispatch('refreshComponent');
    }

    public function removeToCart($cartId)
    {
        Cart::instance('cart')->remove($cartId);
        $this->dispatch('refreshComponent');
        flash()->info('Le produit est supprimé du panier.');
    }

    public function destroyCart()
    {
        Cart::instance('cart')->destroy();
        $this->dispatch('refreshComponent');
        flash()->info('Votre panier a été vidé.');
    }

    public function addToCart($productId, $productName, $quantityProduct, $productSalePrice)
    {
        Cart::instance('cart')->add($productId, $productName, $quantityProduct, $productSalePrice)->associate(Product::class);
        $this->dispatch('refreshComponent');
        flash()->success('Le produit ajouté au panier.');
    }

    public function checkout()
    {
        if (Auth::check()) {
            return redirect()->route('checkout');
        }else{
            return redirect()->route('login');
        }
    }

    public function upplyCoupon()
    {
        $coupon = Coupon::where('coupon_code', $this->couponCode)
            ->where('cart_value', '<=', Cart::instance('cart')->subtotal())
            ->where('end_date', '>=', Carbon::today())->first();

        if (!$coupon) {
            flash()->error('Votre coupon n\'est pas valide.');
            return;
        }

        session()->put('coupon', [
            'coupon_code' => $coupon->coupon_code,
            'coupon_type' => $coupon->coupon_type,
            'coupon_value' => $coupon->coupon_value,
            'cart_value' => $coupon->cart_value,
            'end_date' => $coupon->end_date,
        ]);

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

    public function setCheckoutForAmount()
    {
        if (session()->has('coupon')) {
            session()->put('checkout', [
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount
            ]);
        } else {
            session()->put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total(),
            ]);
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

        $this->setCheckoutForAmount();

        $products = Product::inRandomOrder()->take(12)->get();

        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.cart-component', ['products' => $products]);
    }

    #[On('refreshComponent')]
    public function refreshComponent(): void
    {
    }
}
