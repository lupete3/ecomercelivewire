<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Saletimer;
use App\Models\Slider;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;


class HomeComponent extends Component
{
    public $countProductPage = 18;
    public $locale;

    public $userCountry = null;

    public function mount()
    {
        $this->locale = session('locale', config('app.locale'));
        // Détecter le pays de l'utilisateur au chargement du composant
        $this->userCountry = $this->getUserCountry();
    }

    public function getUserCountry()
    {
        // Utiliser une session pour éviter de faire une requête API à chaque fois
        if (session()->has('user_country')) {
            return session('user_country');
        }

        try {
            // Adresse IP de l'utilisateur
            $ip = request()->ip();
            $apiUrl = "http://ip-api.com/json/{$ip}";
            $response = file_get_contents($apiUrl);

            if ($response === false) {
                throw new \Exception("Erreur lors de la récupération des données de géolocalisation.");
            }

            $data = json_decode($response, true);

            if ($data && $data['status'] === 'success') {
                $countryCode = $data['countryCode']; // Exemple : "CD" pour la RDC
                session(['user_country' => $countryCode]);
                return $countryCode;
            }
        } catch (\Exception $e) {
            // Gérer l'erreur (par exemple, définir un pays par défaut)
            session(['user_country' => 'US']); // Pays par défaut (États-Unis)
            return 'US';
        }

        return null; // Retourner null si la détection échoue
    }

    public function getAdjustedPrice($product)
    {
        $originalPrice = $product->sale_price;

        // Appliquer une réduction spécifique pour la RDC
        if ($this->userCountry === 'CD') { // CD = Code ISO pour la RDC
            $discountRate = 0.2; // 20% de réduction
            return $originalPrice * (1 - $discountRate);
        }

        return $originalPrice; // Prix normal pour les autres pays
    }

    public function addToCart($productId, $productName, $quantityProduct, $productSalePrice)
    {
        Cart::instance('cart')->add($productId, $productName, $quantityProduct, $productSalePrice)->associate(Product::class);
        $this->dispatch('refreshComponent');
        flash()->success('Le produit ajouté au panier.');
    }

    public function loadMore()
    {
        $this->countProductPage += 18;
    }

    public function render()
    {
        $sliders = Slider::whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->where('status', 1)->where('type', 'slider')->get();

        $categories = Category::where('status', 1)->get();

        $products = Product::limit($this->countProductPage)->get();

        $popularycategories = Category::latest()->limit(7)->get();

        $newproducts = Product::latest()->limit(7)->get();

        $saleTimersProducts = Product::whereBetween('sale_price', [20,100])->take(12)->get();

        $saleTimer = Saletimer::find(1);

        $best_seller_products = DB::table('products')
            ->leftJoin('order_items','products.id','=','order_items.product_id')
            ->selectRaw('products.id,SUM(order_items.quantity) as total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(8)
            ->get();

        $bestProducts = [];

        foreach ($best_seller_products as $best_seller_product) {

            $bestProduct = Product::findOrFail($best_seller_product->id);
            $bestProducts[] = $bestProduct;
        }

        if (Auth::check()) {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
        }

        return view('livewire.home-component', [
            'sliders' => $sliders,
            'categories' => $categories,
            'products' => $products,
            'popularycategories' => $popularycategories,
            'newproducts' => $newproducts,
            'bestProducts' => $bestProducts,
            'saleTimersProducts' => $saleTimersProducts,
            'saleTimer' => $saleTimer,
        ]);
    }

    #[On('refreshComponent')]
    public function refreshComponent(): void
    {
    }
}
