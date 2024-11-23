<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Order Details')]
class MyOrderDetailPage extends Component
{
    public $order_id;
    public $order;

    public function mount($order_id)
    {
        $this->order_id = $order_id;

        // Fetch the order with related items and address or abort if not found
        $this->order = Order::with(['items.product', 'address'])->find($this->order_id);

        if (!$this->order) {
            abort(404, 'Order not found'); // Gracefully abort with 404
        }
    }

    public function render()
    {
        return view('livewire.my-order-detail-page', [
            'order' => $this->order,
        ]);
    }
}
