<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $ordersPerPage = 10;
    public $selectedOrder = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function changeOrdersPerPage($number)
    {
        $this->ordersPerPage = $number;
    }

    public function updateStatus($newStatus)
    {
        if ($this->selectedOrder) {
            $this->selectedOrder->status = $newStatus;
            $this->selectedOrder->save();

            $this->dispatch('hideOrderDetailsModal');
            $this->dispatch('refreshComponent');
            flash()->success('Statut de commande mis à jour.');
            $this->selectedOrder = $this->selectedOrder->fresh(); // pour rafraîchir dans la modale
        }
    }


    public function showDetails($orderId)
    {
        $this->selectedOrder = Order::with('orderItems.product')->find($orderId);
        $this->dispatch('showOrderDetailsModal');
    }

    public function markAsDelivered()
    {
        if ($this->selectedOrder) {
            $this->selectedOrder->status = 'delivered';
            $this->selectedOrder->save();

            $this->dispatch('hideOrderDetailsModal');
            $this->dispatch('refreshComponent');
            flash()->success('La commande a été marquée comme livrée.');

        }
    }


    public function render()
    {
        $orders = Order::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('phone', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'. $this->search .'%')
            ->orWhere('city', 'like', '%'. $this->search .'%')
            ->orWhere('adress', 'like', '%'. $this->search .'%')
            ->orWhere('status', 'like', '%'. $this->search .'%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->ordersPerPage);

        return view('livewire.admin.orders.orders-component', compact('orders'));
    }
}
