<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ShopComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $productPerPage = 12;

    public $shortProductBy = 'Defaut';

    public $min_price;
    public $max_price;

    public function mount($min_price = 0, $max_price = 1000)
    {
        $this->min_price = $min_price;
        $this->max_price = $max_price;
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
        Cart::instance('cart')->add($productId, $productName, $quantityProduct, $productSalePrice)->associate(Product::class);
        $this->dispatch('refreshComponent');
        flash()->success('Le produit ajouté au panier.');
    }

    public function addToWishlist($productId, $productName, $productSalePrice)
    {
        Cart::instance('wishlist')->add($productId, $productName, 1, $productSalePrice)->associate(Product::class);
        $this->dispatch('refreshComponent');
        flash()->success('Le produit ajouté aux favoris.');
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
        $categories = Category::all();

        if ($this->shortProductBy == 'Bas a Haut') {
            $products = Product::whereBetween('sale_price', [$this->min_price, $this->max_price])->orderBy('sale_price', 'asc')->paginate($this->productPerPage);
        }elseif ($this->shortProductBy == 'Haut en Bas') {
            $products = Product::whereBetween('sale_price', [$this->min_price, $this->max_price])->orderBy('sale_price', 'desc')->paginate($this->productPerPage);
        }elseif ($this->shortProductBy == 'Nouveaux Produits') {
            $products = Product::whereBetween('sale_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'desc')->paginate($this->productPerPage);
        }else{
            $products = Product::whereBetween('sale_price', [$this->min_price, $this->max_price])->paginate($this->productPerPage);
        }

        $newProducts = Product::latest()->take(3)->get();

        return view('livewire.shop-component', [
            'categories' => $categories,
            'products' => $products,
            'newProducts' => $newProducts,
        ]);
    }

    #[On('refreshComponent')]
    public function refreshComponent(): void
    {
    }
}
