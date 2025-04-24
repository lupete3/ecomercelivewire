<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class DetailsComponent extends Component
{
    public $slug;

    public $quantityProduct = 1;

    public $productColor;
    public $productSize;

    public $productId;
    public $productName;
    public $productShortDescription;
    public $productSalePrice;
    public $productRegularPrice;
    public $productQuantity;
    public $productImagesView;
    public $productSizeView = [];
    public $productColorView= [];

    public $productQuickSize;
    public $productQuickColor;


    public function increment($productQuantity)
    {
        if ($productQuantity > $this->quantityProduct) {
            $this->quantityProduct++;
        }else{
            flash()->info('Cette quantité n\'est pas dispobible ! il reste '.$productQuantity.' en stock');
        }
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

    public function addToCartQuickView($productId, $productName, $productSalePrice)
    {
        $cart = Cart::instance('cart')
            ->add($productId, $productName, $this->quantityProduct, $productSalePrice, ['color' => $this->productQuickColor, 'size' => $this->productQuickSize])
            ->associate(Product::class);

        $this->dispatch('refreshComponent');

        $this->dispatch('hideQuickViewModal');


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

    public function showProductQuickViewModal($productId)
    {
        $product = Product::where('id', $productId)->first();

        $this->productId = $product->id;
        $this->productName = $product->name;
        $this->productShortDescription = $product->short_description;
        $this->productSalePrice = $product->sale_price;
        $this->productRegularPrice = $product->regular_price;
        $this->productQuantity = $product->quantity;

        $this->productImagesView = $product->image;

        $this->productSizeView = json_decode($product->size);

        $this->productColorView = json_decode($product->color);

        $this->dispatch('showProductQuickViewModal');
    }

    public function resentQuantity()
    {
        $this->quantityProduct = 1;
        $this->productQuickSize = '';
        $this->productQuickColor = '';
    }


    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $productImages = json_decode($product->images);

        array_splice($productImages, 0, 0, $product->image);

        $relatedProducts = Product::where('category_id', $product->category_id)->get();

        $newProducts = Product::latest()->take(3)->get();

        $categories = Category::all();

        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.details-component', [
            'product' => $product,
            'productImages' => $productImages,
            'relatedProducts' => $relatedProducts,
            'newProducts' => $newProducts,
            'categories' => $categories,
        ]);
    }

    #[On('refreshComponent')]
    public function refreshComponent(): void
    {
    }
}
