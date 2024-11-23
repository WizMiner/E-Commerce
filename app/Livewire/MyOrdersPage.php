<?php

namespace App\Livewire;

use id;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('My Order')]

class MyOrdersPage extends Component
{
    use WithPagination;

    public $itemsPerPage = 10; // Default items per page

    public function setItemsPerPage($count)
    {
        $this->itemsPerPage = $count; // Update the items per page
    }

    public function render()
    {
        $my_orders = Order::where('user_id', auth()->id())->latest()->paginate($this->itemsPerPage);

        return view('livewire.my-orders-page', [
            'orders' => $my_orders,
        ]);
    }
}
