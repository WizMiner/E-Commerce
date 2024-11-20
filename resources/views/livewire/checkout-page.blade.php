<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white">
        Checkout
    </h1>
    <form wire:submit.prevent='placeOrder'>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 md:col-span-12 lg:col-span-8">
                <!-- Card -->
                <div class="p-4 bg-white shadow rounded-xl sm:p-7 dark:bg-slate-900">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2 class="mb-2 text-xl font-bold text-gray-700 underline dark:text-white">
                            Shipping Address
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="first_name">
                                    First Name
                                </label>
                                <input wire:model='first_name'
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none @error('first_name') border-red-500 @enderror"
                                    id="first_name" type="text">
                                </input>
                                @error('first_name')
                                    <div class="text-sm text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="last_name">
                                    Last Name
                                </label>
                                <input wire:model='last_name'
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none @error('last_name') border-red-500 @enderror"
                                    id="last_name" type="text">
                                </input>
                                @error('last_name')
                                    <div class="text-sm text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block mb-1 text-gray-700 dark:text-white" for="phone">
                                Phone
                            </label>
                            <input wire:model='phone'
                                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none @error('phone') border-red-500 @enderror"
                                id="phone" type="text">
                            </input>
                            @error('phone')
                                <div class="text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block mb-1 text-gray-700 dark:text-white" for="address">
                                Address
                            </label>
                            <input wire:model='street_address'
                                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none @error('street_address') border-red-500 @enderror"
                                id="address" type="text">
                            </input>
                            @error('street_address')
                                <div class="text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block mb-1 text-gray-700 dark:text-white" for="city">
                                City
                            </label>
                            <input wire:model='city'
                                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none @error('city') border-red-500 @enderror"
                                id="city" type="text">
                            </input>
                            @error('city')
                                <div class="text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="state">
                                    State
                                </label>
                                <input wire:model='state'
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none @error('state') border-red-500 @enderror"
                                    id="state" type="text">
                                </input>
                                @error('state')
                                    <div class="text-sm text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="zip">
                                    ZIP Code
                                </label>
                                <input wire:model='zip_code'
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none @error('zip_code') border-red-500 @enderror"
                                    id="zip" type="text">
                                </input>
                                @error('zip_code')
                                    <div class="text-sm text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 text-lg font-semibold">
                        Select Payment Method
                    </div>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input wire:model='payment_method' class="hidden peer" id="hosting-small" required=""
                                type="radio" value="cod" />
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="hosting-small">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Cash on Delivery
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                        </li>
                        <li>
                            <input wire:model='payment_method' class="hidden peer" id="hosting-big" type="radio"
                                value="stripe">
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="hosting-big">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Stripe
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                            </input>
                        </li>
                    </ul>
                    @error('payment_method')
                        <div class="text-sm text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- End Card -->
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-4">
                <div class="p-4 bg-white shadow rounded-xl sm:p-7 dark:bg-slate-900">
                    <div class="mb-2 text-xl font-bold text-center text-gray-700 underline dark:text-white">
                        ORDER SUMMARY
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Sub Total
                        </span>
                        <span>
                            {{ Number::currency($grand_total, 'ETH') }}
                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-serif">
                        <span>
                            Taxes
                        </span>
                        <span>
                            {{ Number::currency(0, 'ETH') }}
                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-serif">
                        <span>
                            Shipping Cost
                        </span>
                        <span>
                            {{ Number::currency(0, 'ETH') }}
                        </span>
                    </div>
                    <hr class="h-1 my-4 rounded bg-slate-400">
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Grand Total
                        </span>
                        <span>
                            {{ Number::currency($grand_total, 'ETH') }}
                        </span>
                    </div>
                    </hr>
                </div>
                <button type="submit"
                    class="w-full p-3 mt-4 font-mono text-lg text-white bg-green-500 rounded-lg hover:bg-green-600 hover:font-serif">
                    <span wire:loading.remove>Place Order</span>
                    <span wire:loading>Processing....</span>
                </button>
                <div class="p-4 mt-4 bg-white shadow rounded-xl sm:p-7 dark:bg-slate-900">
                    <div class="mb-2 text-xl font-bold text-center text-gray-700 underline dark:text-white">
                        BASKET SUMMARY
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                        @foreach ($cart_items as $cart)
                            <li wire:key='{{ $cart['product_id'] }}' class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="{{ $cart['name'] }}" class="w-12 h-12 rounded-full"
                                            src="{{ url('storage', $cart['images']) }}">
                                        </img>
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $cart['name'] }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            Quantity: {{ $cart['quantity'] }}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ Number::currency($cart['total_amount'], 'ETH') }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
