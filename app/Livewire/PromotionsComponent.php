<?php

namespace App\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class PromotionsComponent extends Component
{
    public $countProduct = 18;

    public function addToCart($productId, $productName, $quantityProduct, $productSalePrice)
    {
        Cart::instance('cart')->add($productId, $productName, $quantityProduct, $productSalePrice)->associate(Product::class);
        $this->dispatch('refreshComponent');
        flash()->success('Le produit ajouté au panier.');
    }

    public function infiteScroll()
    {
        $this->countProduct += 12;
    }

    public function render()
    {
        $products = Product::orderBy('id','desc')->take($this->countProduct)->get();

        return view('livewire.promotions-component', ['products' => $products]);
    }
}
