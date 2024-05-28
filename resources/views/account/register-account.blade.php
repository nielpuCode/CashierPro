{{-- account/register-account.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashierPro</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/logo_CashierPro.png') }}">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex h-screen">
    @include('sidebar')

    <div class="flex-grow p-4 overflow-y-auto h-full border-2">
        <div class="border-0 w-full h-full flex flex-col items-center justify-center">
            <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4 mx-auto w-full max-w-md">
                <h2 class="text-2xl font-semibold mb-4 text-center">Register</h2>
                
                <form action="/registerAccountRoute" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                        <input type="text" id="name" name="name" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Full Name Here..." required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Email Here..." required>
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 font-semibold mb-2">Role</label>
                        <select id="role" name="role" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Password Here..." required>
                    </div>
                    <div class="mb-4 flex items-center justify-center">
                        <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
