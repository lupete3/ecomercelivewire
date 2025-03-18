<?php

namespace App\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistComponent extends Component
{

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
