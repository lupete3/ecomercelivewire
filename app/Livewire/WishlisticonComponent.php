<?php

namespace App\Livewire;

use Livewire\Component;

class WishlisticonComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.wishlisticon-component');
    }
}
