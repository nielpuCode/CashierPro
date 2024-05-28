{{-- order/detailorder.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CashierPro</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/logo_CashierPro.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    {{-- please don't change this tailwindCSS CDN below --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

</head>
<body class="flex h-screen bg-gray-100">
    @include('sidebar')
    <div class="w-full p-4 overflow-y-auto max-h-screen border-2 bg-white rounded-lg shadow-lg">
        <div class="flex flex-col cursor-default h-full overflow-y-auto">
            <div class="flex flex-row justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold text-gray-800 gradient-text">#{{ $order->order_code }}</h1>
                <div>
                    <p class="text-sm text-gray-600">Created at: <br class="md:hidden"/><span class="font-bold">{{ $order->created_at->format('D, m/d/Y') }}</span></p>
                </div>
            </div>

            <div class="mb-4 rounded-lg bg-teal-100/30 px-4 py-2">
                <table class="w-full text-center">
                    <thead>
                        <tr class="border-b-2 border-gray-400">
                            <th class="text-lg font-semibold text-gray-800">Item Name</th>
                            <th class="text-lg font-semibold text-gray-800">Quantity</th>
                            <th class="text-lg font-semibold text-gray-800">Item Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($placedOrders as $placedOrder)
                        <tr class="border-b border-gray-200">
                            <td class="py-2 text-gray-700">{{ optional($placedOrder->item)->name }}</td>
                            <td class="py-2 text-gray-700">{{ $placedOrder->quantity }}</td>
                            <td class="py-2 text-gray-700">${{ number_format($placedOrder->item_price, 2) }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-row justify-between items-center">
                <h1 class="text-lg font-semibold text-gray-800">Total</h1>
                @php
                    $totalOrderPrice = 0;
                    foreach ($placedOrders as $placedOrder) {
                        $totalOrderPrice += $placedOrder->item_price * $placedOrder->quantity;
                    }
                @endphp
                <h1 class="text-lg font-semibold text-green-600">${{ number_format($totalOrderPrice, 2) }}</h1>
            </div>
        </div>
    </div>
</body>
</html>


