<x-mail::message>
# Order Placed Successfully!

Thank you for shopping with us! Your order number is **{{ $order->id }}**.

We’re excited to process your order and get your items delivered to you as soon as possible.
If you have any questions or need to modify your order, feel free to reach out to our support team.

<x-mail::button :url="$url">
View Order
</x-mail::button>

Thanks again for choosing us!
**{{ config('app.name') }}**

Need help? Contact our support team at
[**mintesinottamene0917@gmail.com**](mailto:support@ecommerce.com).

© {{ now()->year }} {{ config('app.name') }}. All rights reserved.
</x-mail::message>
