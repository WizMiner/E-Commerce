<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Cart-Marketing')]

class CartPage extends Component
{
    public $cart_items = [];
    public $grand_total;

    public function mount(){
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }


    public function render()
    {
        return view('livewire.cart-page');
    }
}
