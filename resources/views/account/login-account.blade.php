<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashierPro</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/logo_CashierPro.png') }}">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="flex h-screen">
    @include('sidebar')

    <div class="flex-grow p-4 overflow-y-auto h-full border-2 bg-white">
        <div class="border-0 w-full h-full flex flex-col items-center justify-center">
            <div class="shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4 mx-auto w-full max-w-md bg-gray-100/30 border-teal-400 border-2">
                <h2 class="text-2xl font-semibold mb-4 text-center">Login</h2>
                <form action="/loginAccountRoute" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" id="email" placeholder="Email Here..." name="email" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" id="password" placeholder="Password Here..." name="password" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" required>
                    </div>
                    <div class="mb-4 flex flex-col items-center justify-between">
                        <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
                        <a href="/registerPage" class="text-teal-500 hover:text-teal-600 text-sm mt-2">Create Account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
