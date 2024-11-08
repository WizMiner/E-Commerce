<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container px-4 mx-auto">
        <h1 class="mb-4 text-2xl font-semibold">Shopping Cart</h1>
        <div class="flex flex-col gap-4 md:flex-row">
            <div class="md:w-3/4">
                <div class="p-6 mb-4 overflow-x-auto bg-white rounded-lg shadow-md">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="font-semibold text-left">Product</th>
                                <th class="font-semibold text-left">Price</th>
                                <th class="font-semibold text-left">Quantity</th>
                                <th class="font-semibold text-left">Total</th>
                                <th class="font-semibold text-left">Remove</th>
                            </tr>
                        </thead>

                        @forelse ($cart_items as $item)
                            <tr wire:key='{{ $item['product_id'] }}'>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img class="w-16 h-16 mr-4" src="{{ url('storage', $item['images']) }}"
                                            alt="{{ $item['name'] }}">
                                        <span class="font-semibold">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td class="py-4">{{ Number::currency($item['unit_amount'], 'ETH') }} </td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <div class="flex items-center quantity-buttons">
                                            <button wire:click='decreaseQty({{ $item['product_id'] }})'
                                                class="px-4 py-2 mr-2 border rounded-md hover:bg-gray-200">
                                                -
                                            </button>
                                            <span class="w-8 text-center">{{ $item['quantity'] }} </span>
                                            <button wire:click='increaseQty({{ $item['product_id'] }})'
                                                class="px-4 py-2 ml-2 border rounded-md hover:bg-gray-200">
                                                +
                                            </button>
                                        </div>

                                </td>
                                <td class="py-4">{{ Number::currency($item['total_amount'], 'ETH') }}</td>
                                <td>
                                    <button wire:click='removeItem({{ $item['product_id'] }})'
                                        class="px-3 py-1 border-2 rounded-lg bg-slate-300 border-slate-400 hover:bg-red-500 hover:text-white hover:border-red-700"><span
                                            wire:loading.remove
                                            wire:target='removeItem({{ $item['product_id'] }})'>Remove</span><span
                                            wire:loading
                                            wire:target='removeItem({{ $item['product_id'] }})'>Removing...</span></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-4xl font-semibold text-center text-slate-500">
                                    no items available in cart!
                                </td>
                            </tr>
                        @endforelse




                        <tbody>
                            <!-- More product rows -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-lg font-semibold">Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span>Sum Total</span>
                        <span>{{ Number::currency($grand_total, 'ETH') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Taxes</span>
                        <span>{{ Number::currency(0, 'ETH') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Shipping</span>
                        <span>{{ Number::currency(0, 'ETH') }}</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Grand Total</span>
                        <span class="font-semibold">{{ Number::currency($grand_total, 'ETH') }}</span>
                    </div>
                    @if ($cart_items)
                        <a href="/checkout" class="block w-full mt-4 text-center text-white bg-blue-500 rounded-lg y-2 bpx-4">Checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
