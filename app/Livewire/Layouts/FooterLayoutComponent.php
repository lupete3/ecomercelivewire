<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class FooterLayoutComponent extends Component
{
    public $locale;

    public function mount()
    {
        $this->locale = session('locale', config('app.locale'));
    }

    public function render()
    {
        return view('livewire.layouts.footer-layout-component');
    }
}
