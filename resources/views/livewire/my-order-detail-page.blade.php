<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">Order Details</h1>

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Customer
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <div>
                            {{ $order->address->full_name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 22h14" />
                        <path d="M5 2h14" />
                        <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                        <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Order Date
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
                            {{ $order->created_at->format('d-m-Y') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
                        <path d="m12 12 4 10 1.7-4.3L22 16Z" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Order Status
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        @php
                            $status = '';
                            $payment_status = '';
                            if ($order->status == 'new') {
                                $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow"> New </span>';
                            }
                            if ($order->status == 'processing') {
                                $status =
                                    '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow"> Processing </span>';
                            }
                            if ($order->status == 'shipped') {
                                $status =
                                    '<span class="bg-green-500 py-1 px-3 rounded text-white shadow"> Shipped </span>';
                            }
                            if ($order->status == 'delivered') {
                                $status =
                                    '<span class="bg-green-700 py-1 px-3 rounded text-white shadow"> Delivered </span>';
                            }
                            if ($order->status == 'cancelled') {
                                $status =
                                    '<span class="bg-red-500 py-1 px-3 rounded text-white shadow"> Cancelled </span>';
                            }

                            // payment_status
                            if ($order->payment_status == 'pending') {
                                $payment_status =
                                    '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow"> Pending </span>';
                            }
                            if ($order->payment_status == 'paid') {
                                $payment_status =
                                    '<span class="bg-green-600 py-1 px-3 rounded text-white shadow"> Paid </span>';
                            }
                            if ($order->payment_status == 'failed') {
                                $payment_status =
                                    '<span class="bg-red-600 py-1 px-3 rounded text-white shadow"> Failed </span>';
                            }

                        @endphp
                            {!! $status !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
                        <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
                        <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Payment Status
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        {!! $payment_status !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Grid -->

    <div class="flex flex-col md:flex-row gap-4 mt-4">
        <div class="md:w-3/4">
            <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200 mb-4">
                <table class="w-full bg-white min-w-[600px]">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left font-semibold px-4 md:px-6 py-3 text-sm md:text-base text-gray-600">
                                Product</th>
                            <th class="text-left font-semibold px-4 md:px-6 py-3 text-sm md:text-base text-gray-600">
                                Price</th>
                            <th class="text-center font-semibold px-4 md:px-6 py-3 text-sm md:text-base text-gray-600">
                                Quantity</th>
                            <th class="text-right font-semibold px-4 md:px-6 py-3 text-sm md:text-base text-gray-600">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr
                                class="group relative transition-transform duration-300 hover:scale-105 hover:shadow-xl hover:z-10">
                                <td class="px-4 md:px-6 py-3">
                                    <div class="flex items-center">
                                        <div
                                            class="relative p-[2px] rounded-lg bg-[conic-gradient(at_top,_#e66465,_#9198e5)] group-hover:animate-spin">
                                            <img class="h-12 w-12 md:h-16 md:w-16 rounded-lg object-cover"
                                                src="{{ url('storage', $item->product->images[0]) }}"
                                                alt="{{ $item->product->name }}">
                                        </div>
                                        <span class="font-semibold text-gray-700 ml-3 md:ml-4 text-sm md:text-base">
                                            {{ $item->product->name }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-3 text-gray-700 text-sm md:text-base">
                                    {{ Number::currency($item->unit_amount, 'INR') }}
                                </td>
                                <td class="px-4 md:px-6 py-3 text-center text-gray-700 text-sm md:text-base">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-4 md:px-6 py-3 text-right text-gray-700 text-sm md:text-base">
                                    {{ Number::currency($item->total_amount, 'INR') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                <h1 class="font-3xl font-bold text-slate-500 mb-3">Shipping Address</h1>
                <div class="flex justify-between items-center">
                    <div>
                        <p>
                            {{ $order->address->street_address }}, {{ $order->address->city }},
                            {{ $order->address->state }}, {{ $order->address->zip_code }}</p>

                    </div>
                    <div>
                        <p class="font-semibold">Phone:</p>
                        <p>
                            {{ $order->address->phone }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="md:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Summary</h2>
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span>
                        {{ Number::currency($item->order->grand_total, 'INR') }}
                    </span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Taxes</span>
                    <span>₹0.00</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Shipping</span>
                    <span>₹0.00</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Grand Total</span>
                    <span class="font-semibold">
                        {{ Number::currency($item->order->grand_total, 'INR') }}
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
