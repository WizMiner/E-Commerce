<?php

namespace App\Livewire;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use App\Mail\OrderPlaced;
use Stripe\Checkout\Session;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use Illuminate\Support\Facades\Mail;

#[Title('checkout')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method;


    public function mount()
    {
        // Retrieve cart items
        $cart_items = CartManagement::getCartItemsFromCookie();

        // Redirect if the cart is empty
        if (empty($cart_items) || count($cart_items) === 0) {
            $redirect_url = route('products'); // Use named route for redirection
            return redirect($redirect_url);
        }
    }



    /**
     * Handle order placement
     */
    public function placeOrder()
    {
        // Validate user input
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
        ]);

        // Retrieve cart items and prepare line items for Stripe
        $cart_items = CartManagement::getCartItemsFromCookie();
        $line_items = [];

        foreach ($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'inr',
                    'unit_amount' => $item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // Create new order
        $order = new Order();
        $order->user_id = auth()->user()->id; // Correctly access user ID
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'inr';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . auth()->user()->name;

        // Create shipping address
        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        // Determine redirection URL based on payment method
        $redirect_url = '';

        if ($this->payment_method === 'stripe') {
            // Setup Stripe payment session
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $sessionCheckout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'),
            ]);

            $redirect_url = $sessionCheckout->url;
        } else {
            // For non-Stripe payments, direct to success page
            $redirect_url = route('success');
        }

        // Save order and address to the database
        $order->save();
        $address->order_id = $order->id;
        $address->save();

        // Save order items
        $order->items()->createMany($cart_items);

        // Clear cart items and redirect user
        CartManagement::clearCartItems();
        Mail::to(request()->user())->send(new OrderPlaced($order));
        return redirect($redirect_url);
    }

    /**
     * Render the checkout page view
     */
    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
