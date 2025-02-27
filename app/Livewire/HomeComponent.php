<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = Slider::where('status', 1)->where('type', 'slider')->get();

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
