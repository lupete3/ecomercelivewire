<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $slug;

    public $productPerPage = 12;

    public $shortProductBy = 'Defaut';

    public $min_price;
    public $max_price;
    public $locale;
    public $userCountry = null;

    public function mount($slug, $min_price = 0, $max_price = 1000)
    {
        $this->locale = session('locale', config('app.locale'));
        // Détecter le pays de l'utilisateur au chargement du composant
        $this->userCountry = $this->getUserCountry();

        $this->slug = $slug;
        $this->min_price = $min_price;
        $this->max_price = $max_price;
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

    public function changeProductPerPage($pageSize)
    {
        $this->productPerPage = $pageSize;
    }

    public function changeShortBy($hortBy)
    {
        $this->shortProductBy = $hortBy;
    }

    public function addToCart($productId, $productName, $quantityProduct, $productSalePrice)
    {
        $cart = Cart::instance('cart')
            ->add($productId, $productName, $quantityProduct, $productSalePrice)
            ->associate(Product::class);

        $this->dispatch('refreshComponent');
        flash()->success('Le produit ajouté au panier.');

        //return redirect()->route('cart');
    }

    public function render()
    {
        $category = Category::where('slug', $this->slug)->first();

        $categories = Category::all();

        if ($this->shortProductBy == 'Bas a Haut') {
            $products = Product::where('category_id', $category->id)->whereBetween('sale_price', [$this->min_price, $this->max_price])->orderBy('sale_price', 'asc')->paginate($this->productPerPage);
        }elseif ($this->shortProductBy == 'Haut en Bas') {
            $products = Product::where('category_id', $category->id)->whereBetween('sale_price', [$this->min_price, $this->max_price])->orderBy('sale_price', 'desc')->paginate($this->productPerPage);
        }elseif ($this->shortProductBy == 'Nouveaux Produits') {
            $products = Product::where('category_id', $category->id)->whereBetween('sale_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'desc')->paginate($this->productPerPage);
        }else{
            $products = Product::where('category_id', $category->id)->whereBetween('sale_price', [$this->min_price, $this->max_price])->paginate($this->productPerPage);
        }

        $newProducts = Product::latest()->take(3)->get();

        return view('livewire.category-component', [
            'categories' => $categories,
            'category' => $category,
            'products' => $products,
            'newProducts' => $newProducts,
        ]);
    }
}
