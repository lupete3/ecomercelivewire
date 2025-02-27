<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ThankyouComponent extends Component
{
    public function render()
    {
        $order = Order::where('user_id', Auth::id())->get()->last();

        return view('livewire.thankyou-component', ['order' => $order]);
    }
}
