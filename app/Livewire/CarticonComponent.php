<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CarticonComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function removeToCart($cartId)
    {
        Cart::instance('cart')->remove($cartId);
        $this->dispatch('refreshComponent');
        flash()->success('Le produit est supprimé du panier.');
    }

    public function render()
    {
        return view('livewire.carticon-component');
    }
}
