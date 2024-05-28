{{-- transaction.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CashierPro</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/logo_CashierPro.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    {{-- please don't change this tailwindCSS CDN below --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen">
    @include('sidebar')
    <div class="w-full p-4 overflow-y-auto max-h-screen border-0">
        <section class="flex flex-row items-center justify-between w-full border-0 gap-x-2 md:gap-x-4 my-2">
            <input name="search" placeholder="Find Item..." type="text" class="rounded-lg border-2 w-[85%] px-3 py-1" />
            @auth
            <a href="/updateAccountPage" class="w-[15%] rounded-lg bg-teal-800 hover:bg-teal-500 text-white flex flex-row items-center justify-center gap-x-2 py-1 px-2 text-center">{{ auth()->user()->name }}</a>
            @else
            <a href="/loginPage" class="w-[15%] rounded-lg bg-teal-800 hover:bg-teal-500 text-white flex flex-row items-center justify-center gap-x-2 py-1 px-2 text-center">
                <span class="hidden md:block"><i class="fa-solid fa-user hidden"></i></span> Login</a>
            @endauth
        </section>

        <section class="flex flex-row overflow-x-auto gap-x-4 snap-x border-0 h-[800px]">
            {{-- Item display --}}
            <div class="flex flex-row flex-wrap items-start justify-around border-0 w-full md:w-[65%] gap-4 max-h-[800px] overflow-auto pr-1 py-3 scrollbar-teal-800 md:shrink-1 shrink-0 snap-center">
                @foreach ($itemInventory as $item)
                    @if ($item->quantity > 0)
                        <div class="relative bg-white shadow-lg rounded-lg overflow-hidden w-[90%] md:w-44">
                            {{-- Promo Badge --}}
                            {{-- <div class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1 rounded-tr-lg rounded-bl-lg">
                                <span class="text-xs font-semibold">15%</span>
                            </div> --}}
                            <div class="h-40 w-full flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Item Image" class="object-cover h-full w-full">
                            </div>
                            <div class="p-4">
                                <p class="text-sm text-teal-400">#492831</p>
                                <h1 class="text-xl font-semibold mb-2 truncate">{{ \Illuminate\Support\Str::limit($item->name, 20, '...') }}</h1>
                                <div class="flex justify-between items-center">
                                    <h1 class="text-lg font-semibold"><span class="text-green-600">$</span>{{ $item['price'] }}</h1>
                                    <form action="{{ route('addToCart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="1"> <!-- Assuming default quantity is 1 -->
                                        <input type="hidden" name="price" value="{{ $item->price }}">

                                        @auth
                                            <button type="submit" class="text-white bg-teal-800 hover:bg-teal-500 font-semibold py-1 px-2 rounded-md add-to-cart-btn">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        @endauth
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            
            <!-- Cart List -->
            <div class="flex flex-col border-0 md:shrink-1 shrink-0 w-full md:w-[30%] snap-center">
                @auth
                <div class="flex flex-col p-4 border-2 rounded-lg">
                    <div class="flex flex-row justify-between items-center border-b-2 pb-2">
                        <p class="text-xl font-semibold">Cart List</p>
                        <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::now()->format('D, M jS Y') }}</p>
                    </div>
                    <!-- Cart Items -->
                    <div id="cart-items" class="bg-white overflow-hidden border-0 p-2 mt-2 h-80 overflow-y-auto scrollbar-teal-800 rounded-lg">
                        @foreach ($cartItems as $cartItem)
                        <div class="flex items-center justify-between border-b py-2">
                            <img src="{{ asset('storage/' . $cartItem->item->image) }}" class="w-16 h-10 rounded-md object-cover mr-4">
                            <div class="flex flex-grow justify-between items-center">
                                <div>
                                    <p class="text-lg font-semibold">{{ $cartItem->item->name }}</p>
                                    <div class="flex items-center">
                                        <!-- Decrease quantity button -->
                                        <form action="{{ route('decreaseQuantity', ['id' => $cartItem->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-gray-600 focus:outline-none remove-from-cart-btn">
                                                <i class="fas fa-minus-circle hover:text-red-700 text-red-500 text-lg"></i>
                                            </button>
                                        </form>
                                        
                                        <!-- Display quantity -->
                                        <span class="text-lg font-semibold mx-2 quantity">{{ $cartItem->quantity }}</span>
                                        
                                        <!-- Increase quantity button -->
                                        <form action="{{ route('increaseQuantity', ['id' => $cartItem->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-gray-600 focus:outline-none add-to-cart-btn">
                                                <i class="fas fa-plus-circle hover:text-green-700 text-green-500 text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <p class="price">${{ $cartItem->price }}</p> 
                            </div>
                            
                        </div>
                        @endforeach
                    </div>
                    <!-- Total Amount -->
                    <div id="total-amount" class="flex flex-row justify-between mt-4 border-t-2">
                        <p class="text-lg font-semibold">Total:</p>
                        <p id="total-price" class="text-lg font-semibold">$ {{ $totalPrice }}</p>
                    </div>
                    <button type="button" id="checkout-button" class="mt-4 bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Check Out</button>
                </div>
                @endauth
            </div>
        </section>
    </div>

    {{-- Popup for payment --}}
    <div id="payment-popup" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="border-0 rounded-lg bg-white w-1/2 h-fit p-6 shadow-lg m-auto">
            <h1 class="text-xl md:text-5xl font-bold text-gray-800 mb-4">TOTAL: <span id="popup-total-price" class="text-teal-600">$0.00</span></h1>
            
            <input type="number" id="payment-amount" placeholder="Input Nominal..." class="w-full p-2 border rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-teal-500" />
            
            <div class="flex justify-end space-x-4">
                <button id="cancel-button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">Cancel</button>
                <button id="pay-button" class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">Pay!</button>
            </div>
        </div>
    </div>

    <form id="checkout-form" action="{{ route('checkout') }}" method="POST" class="hidden">
        @csrf
        @foreach ($cartItems as $cartItem)
        <div class="flex flex-row border-2 p-1">
            <input type="text" name="cartItems[{{ $loop->index }}][item_id]" value="{{ $cartItem->item_id }}">
        <input type="text" name="cartItems[{{ $loop->index }}][quantity]" value="{{ $cartItem->quantity }}">
        <input type="text" name="cartItems[{{ $loop->index }}][item_price]" value="{{ $cartItem->price }}">

        </div>
        @endforeach
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const checkoutButton = document.getElementById('checkout-button');
            const paymentPopup = document.getElementById('payment-popup');
            const cancelButton = document.getElementById('cancel-button');
            const payButton = document.getElementById('pay-button');
            const totalPriceElement = document.getElementById('total-price');
            const popupTotalPriceElement = document.getElementById('popup-total-price');
            const paymentAmountInput = document.getElementById('payment-amount');
            const checkoutForm = document.getElementById('checkout-form');

            checkoutButton.addEventListener('click', () => {
                const totalPrice = totalPriceElement.textContent;
                popupTotalPriceElement.textContent = totalPrice;
                paymentPopup.classList.remove('hidden');
            });

            cancelButton.addEventListener('click', () => {
                paymentPopup.classList.add('hidden');
                paymentAmountInput.value = '';
            });

            payButton.addEventListener('click', () => {
                const totalPrice = parseFloat(totalPriceElement.textContent.replace('$', ''));
                const paymentAmount = parseFloat(paymentAmountInput.value);

                if (paymentAmount >= totalPrice) {
                    checkoutForm.submit();
                } else {
                    alert('Insufficient amount. Please input the correct amount.');
                }
            });
        });
    </script>
</body>
</html>
