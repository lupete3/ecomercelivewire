<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class HomeComponent extends Component
{
    public function addToCart($productId, $productName, $quantityProduct, $productSalePrice)
    {
        Cart::instance('cart')->add($productId, $productName, $quantityProduct, $productSalePrice)->associate(Product::class);
        $this->dispatch('refreshComponent');
        flash()->success('Le produit ajouté au panier.');
    }

    public function render()
    {
        $sliders = Slider::whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->where('status', 1)->where('type', 'slider')->get();

        $categories = Category::where('status', 1)->get();

        $products = Product::limit(15)->get();

        $popularycategories = Category::latest()->limit(7)->get();

        $populariesproducts = Product::latest()->limit(7)->get();

        return view('livewire.home-component', [
            'sliders' => $sliders,
            'categories' => $categories,
            'products' => $products,
            'popularycategories' => $popularycategories,
            'populariesproducts' => $populariesproducts,
        ]);
    }
}
