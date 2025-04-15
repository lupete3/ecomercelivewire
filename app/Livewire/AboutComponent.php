<?php

namespace App\Livewire;

use App\Models\About;
use Livewire\Component;

class AboutComponent extends Component
{
    public $about;

    public function mount()
    {
        $this->about = About::select('*')->first();
    }
    public function render()
    {
        return view('livewire.about-component', ['about', $this->about]);
    }
}
