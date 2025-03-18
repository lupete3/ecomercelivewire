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

class HomeComponent extends Component
{
    public $countProductPage = 18;

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
}
