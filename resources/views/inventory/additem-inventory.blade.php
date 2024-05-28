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
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

</head>
<body class="flex h-screen bg-gray-100">
    @include('sidebar')

    <div class="flex-grow p-4 md:p-8 max-h-screen overflow-y-auto bg-white">
        @if(auth()->user()->role !== 'admin')
            <div class="w-full h-full flex items-center justify-center">
                <h1 class="text-center font-extrabold text-3xl text-teal-400 border-2 p-4">You are not an admin! Only admins can add items!</h1>
            </div>
        @else
        <div class="flex flex-row gap-3 snap-x w-full">
            <!-- Add Item Form -->
            <div class="w-full md:w-[30%] mx-auto bg-white shadow-lg rounded-lg p-6 snap-center shrink-0 md:shrink-1">
                <h2 class="text-2xl font-semibold mb-6 text-center text-gray-700">Add Item to Inventory</h2>
                <form action="/addItemRoute" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-semibold mb-2">Image</label>
                        <input type="file" id="image" name="image" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500">
                    </div>
                    <div class="mb-4">
                        <label for="barcode" class="block text-gray-700 font-semibold mb-2">Barcode</label>
                        <input type="number" id="barcode" name="barcode" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Barcode" required>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Item Name</label>
                        <input type="text" id="name" name="name" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Item Name" required>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-semibold mb-2">Price</label>
                        <input type="number" id="price" name="price" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Price" required>
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="block text-gray-700 font-semibold mb-2">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Quantity" required>
                    </div>
                    <div class="mb-6 flex justify-center">
                        <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Item</button>
                    </div>
                </form>
            </div>

            <!-- Existing Items Section -->
            <div class="w-full border-0 w-full md:w-[65%] max-h-[850px] md:max-h-[820px] overflow-y-auto scrollbar-teal-800 p-2 snap-center shrink-0 md:shrink-1">
                <h3 class="text-xl font-semibold mb-4 text-gray-700 text-center">Existing Items</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 scrollbar-teal-800">
                    @foreach ($itemInventory as $item)
                        <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col items-center">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Item Image" class="w-full h-40 object-cover mb-4 rounded">
                            <h4 class="text-lg font-semibold mb-2">{{ $item['name'] }}</h4>
                            <p class="text-gray-700 mb-2">Price: {{ $item['price'] }}</p>
                            <p class="text-gray-700 mb-4">Quantity: {{ $item['quantity'] }}</p>
                            <div class="flex space-x-2">
                                <a href="{{ route('updateItem', $item) }}" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-1 px-3 rounded">Edit</a>
                                <form action="{{ route('deleteItem', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            title: "{{ session('success') }}",
            icon: "success"
        });
    </script>
    @endif
</body>
</html>
