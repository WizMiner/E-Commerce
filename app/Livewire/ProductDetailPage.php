<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partial\Navbr;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('products Detail page - Marketing')]

class ProductDetailPage extends Component
{
    use LivewireAlert;

    public $slug;
    public $quantity = 1;

    public function mount($slug){

        $this->slug = $slug;
    }

    public function increaseQty(){
        $this->quantity++;
    }
    public function decreaseQty(){
        if ($this->quantity > 1) {
            $this->quantity--;

        }
    }

        //add product to cart method
        public function addToCart($product_id)
        {
            $total_count = CartManagement::addItemsToCartWithQty($product_id, $this->quantity);
            $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbr::class);

            //Alert
            $this->alert('success', 'Product added to te car successfully!', [
                'position' => 'bottom-end',
                'timer' => 30000,
                'toast' => true,
            ]);
        }


        public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
