<?php

namespace App\Livewire;

use Livewire\Component;

class AppLayout extends Component
{
    public $locale;

    public function mount()
    {
        $this->locale = session('locale', config('app.locale'));
    }

    public function render()
    {
        return view('layouts.app');
    }
}
