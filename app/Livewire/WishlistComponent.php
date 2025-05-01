<?php

namespace App\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistComponent extends Component
{
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

    public function addToCart($productId, $productName, $productSalePrice)
    {
        Cart::instance('cart')->add($productId, $productName, 1, $productSalePrice)->associate(Product::class);

        flash()->success('Le produit ajouté au panier.');

        return redirect()->route('cart');
    }

    public function deleteToWishlist($productId)
    {
        foreach (Cart::instance('wishlist')->content() as $item) {
           if ($item->id == $productId) {
                Cart::instance('wishlist')->remove($item->rowId);
                $this->dispatch('refreshComponent');
                flash()->success('Le produit retiré aux favoris.');
           }
        }
    }

    public function render()
    {
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.wishlist-component');
    }
}
