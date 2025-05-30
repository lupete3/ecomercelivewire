<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;


class CarticonComponent extends Component
{
    public $locale;

    public function mount()
    {
        $this->locale = session('locale', config('app.locale'));
    }

    public function removeToCart($cartId)
    {
        Cart::instance('cart')->remove($cartId);
        $this->dispatch('refreshComponent');
        flash()->success('Le produit est supprimé du panier.');
    }

    public function render()
    {
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.carticon-component');
    }

    #[On('refreshComponent')]
    public function refreshComponent(): void
    {
    }
}
