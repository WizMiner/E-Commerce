<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Stripe\Stripe;
use Stripe\Checkout\Session;

#[Title('Success')]
class SuccessPage extends Component
{
    #[Url]
    public $session_id;

    public function render()
    {
        // Fetch the latest order for the authenticated user
        $latest_order = Order::with(['user', 'address']) // Ensure these relationships exist
            ->where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$latest_order) {
            return redirect()->route('home'); // Or any other appropriate route if no order exists
        }

        // Initialize session_info and check payment status
        if ($this->session_id) {
            // Set your Stripe secret key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $session_info = Session::retrieve($this->session_id);
                if ($session_info->payment_status == 'paid') {
                    // Update the order to mark it as paid
                    $latest_order->payment_status = 'paid';
                    $latest_order->save();
                } else {
                    // Handle failed payment scenario
                    $latest_order->payment_status = 'failed';
                    $latest_order->save();
                    return redirect()->route('cancel'); // Redirect to a cancel route
                }
            } catch (\Exception $e) {
                // Handle error in retrieving the session from Stripe
                $latest_order->payment_status = 'failed';
                $latest_order->save();
                return redirect()->route('cancel');
            }
        } else {
            // If there's no session ID, treat the order as paid by default (you may want to adjust this logic)
            $latest_order->payment_status = 'paid';
            $latest_order->save();
        }

        // Return the success page with the order data
        return view('livewire.success-page', [
            'order' => $latest_order,
        ]);
    }
}
