<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $productPerPage = 12;

    public $shortProductBy = 'Defaut';

    public $min_price;
    public $max_price;

    public $search;
    public $search_term;

    public function mount($min_price = 0, $max_price = 1000)
    {
        $this->min_price = $min_price;
        $this->max_price = $max_price;

        $this->fill(request()->only('search'));
        $this->search_term = '%'.$this->search.'%';
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
        $cart = Cart::add($productId, $productName, $quantityProduct, $productSalePrice)->associate(Product::class);

        flash()->success('Le produit ajouté au panier.');

        return redirect()->route('cart');
    }

    public function render()
    {
        $categories = Category::all();

        if ($this->shortProductBy == 'Bas a Haut') {
            $products = Product::where('name','like',$this->search_term)->whereBetween('sale_price', [$this->min_price, $this->max_price])->orderBy('sale_price', 'asc')->paginate($this->productPerPage);
        }elseif ($this->shortProductBy == 'Haut en Bas') {
            $products = Product::where('name','like',$this->search_term)->whereBetween('sale_price', [$this->min_price, $this->max_price])->orderBy('sale_price', 'desc')->paginate($this->productPerPage);
        }elseif ($this->shortProductBy == 'Nouveaux Produits') {
            $products = Product::where('name','like',$this->search_term)->whereBetween('sale_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'desc')->paginate($this->productPerPage);
        }else{
            $products = Product::where('name','like',$this->search_term)->whereBetween('sale_price', [$this->min_price, $this->max_price])->paginate($this->productPerPage);
        }

        $newProducts = Product::latest()->take(3)->get();

        return view('livewire.search-component', [
            'categories' => $categories,
            'products' => $products,
            'newProducts' => $newProducts,
        ]);
    }
}
