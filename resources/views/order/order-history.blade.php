{{-- order-history.blade.php --}}
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
    <body class="flex h-screen">
        @include('sidebar')
        <div class="bg-white w-full p-4 overflow-y-auto max-h-screen border-0">
            <div class="flex flex-col items-start w-full gap-3 cursor-default h-full overflow-y-auto">
                {{-- order-history.blade.php --}}
                @foreach ($orderHistory as $order)
                    <div class="flex flex-row w-full justify-between items-center border-0 rounded-lg px-3 py-2 mb-2 bg-teal-100/40">
                        <div class="flex flex-col gap-y-2 md:flex-row border-0 w-[80%] justify-between items-start md:items-center">
                            <p class="text-sm font-extrabold gradient-text">#{{ $order->order_code }}</p>
                            <p class="text-sm font-semibold">${{ $order->totalPrice }}</p>
                            <p class="text-sm font-semibold">{{ $order->created_at->format('D, m/d/Y') }}</p>
                        </div>
                        <div> 
                            <button onclick="window.location.href = '{{ route('viewDetailOrder', ['order_id' => $order->id]) }}'" class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">View</button>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>