<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class MenuCategories extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::all(); // ou tout autre filtrage
    }

    public function render()
    {
        return view('livewire.menu-categories');
    }
}
