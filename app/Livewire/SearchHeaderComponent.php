<?php

namespace App\Livewire;

use Livewire\Component;

class SearchHeaderComponent extends Component
{
    public $search;

    public function mount()
    {
        $this->fill(request()->only('search'));
    }

    public function render()
    {
        return view('livewire.search-header-component');
    }
}
