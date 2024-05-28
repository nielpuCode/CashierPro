{{-- inventory/edititem-inventory.blade.php --}}
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
    </head>
    <body class="flex h-screen">
        @include('sidebar')
        <div class="w-full p-4 overflow-y-auto max-h-screen border-2">
            <form method="POST" action="{{ route('updateItemInventory', $item) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">Image</label>
                    <input type="file" id="image" name="image" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500">
                </div>                    
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Item Name</label>
                    <input type="text" id="name" name="name" value="{{ $item->name}}" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Item Name" required>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold mb-2">Price</label>
                    <input type="number" id="price" name="price" value="{{ $item['price'] }}" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Price" required>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 font-semibold mb-2">Barcode</label>
                    <input type="number" id="barcode" name="barcode" value="{{ $item['barcode'] }}" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Quantity" required>
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 font-semibold mb-2">Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="{{ $item['quantity'] }}" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Quantity" required>
                </div>
                <div class="mb-6 flex items-center justify-center">
                    <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Item</button>
                </div>
            </form>
            
        </div>
    </body>
</html>