<?php

namespace App\Livewire;

use Livewire\Component;

class SearchHeaderComponent extends Component
{
    public $search;

    public $locale;

    public function mount()
    {
        $this->locale = session('locale', config('app.locale'));
        $this->fill(request()->only('search'));
    }

    public function render()
    {
        return view('livewire.search-header-component');
    }
}
