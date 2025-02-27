<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class DetailsComponent extends Component
{
    public $slug;

    public $quantityProduct = 1;

    public $productColor;
    public $productSize;



    public function increment()
    {
        $this->quantityProduct++;
    }

    public function decrement()
    {
        if ($this->quantityProduct > 1) {
            $this->quantityProduct--;
        }
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function getProductColor($productColor)
    {
        $this->productColor = $productColor;
    }

    public function getProductSize($productSize)
    {
        $this->productSize = $productSize;
    }

    public function addToCart($productId, $productName, $productSalePrice)
    {
        $cart = Cart::instance('cart')
            ->add($productId, $productName, $this->quantityProduct, $productSalePrice, ['color' => $this->productColor, 'size' => $this->productSize])
            ->associate(Product::class);

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
        $product = Product::where('slug', $this->slug)->first();
        $productImages = json_decode($product->images);

        array_splice($productImages, 0, 0, $product->image);

        $relatedProducts = Product::where('category_id', $product->category_id)->get();

        $newProducts = Product::latest()->take(3)->get();

        $categories = Category::all();

        return view('livewire.details-component', [
            'product' => $product,
            'productImages' => $productImages,
            'relatedProducts' => $relatedProducts,
            'newProducts' => $newProducts,
            'categories' => $categories,
        ]);
    }
}
