<?php

namespace App\Livewire;

use Livewire\Component;

class ContactComponent extends Component
{
    public $locale;

    public function mount($min_price = 0, $max_price = 1000)
    {
        $this->locale = session('locale', config('app.locale'));
    }
    
    public function render()
    {
        return view('livewire.contact-component');
    }
}
