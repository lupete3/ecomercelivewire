<?php

namespace App\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        return view('livewire.wishlist-component');
    }
}
