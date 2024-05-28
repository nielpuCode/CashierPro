{{-- account/update-account.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashierPro</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/logo_CashierPro.png') }}">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex h-screen">

    @include('sidebar')

    <div class="w-full p-2 md:p-8 overflow-y-auto h-screen border-0 bg-white">
        <div class="w-full border-0 rounded-lg h-full flex flex-row overflow-x-auto snap-x justify-around gap-4 items-center">
            
            <form action="/updateAccountRoute" method="POST" autocomplete="off" class="w-full md:w-[80%] border-0 rounded-lg shadow-xl p-8 bg-white shrink-0 snap-center">
                <h2 class="text-2xl font-semibold mb-6 text-center text-gray-700">Update Account</h2>
                @csrf
                <div class="mb-2">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Full Name Here..." value="{{ auth()->user()->name }}" required>
                </div>
                <div class="mb-2">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Email Here..." value="{{ auth()->user()->email }}" required>
                </div>
                <div class="mb-2">
                    <label for="role" class="block text-gray-700 font-semibold mb-2">Role</label>
                    <select id="role" name="role" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" required>
                        <option value="admin" {{ auth()->user()->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ auth()->user()->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="current_password" class="block text-gray-700 font-semibold mb-2">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Current Password" required>
                </div>
                <div class="mb-2">
                    <label for="new_password" class="block text-gray-700 font-semibold mb-2">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="New Password" required>
                </div>
                <div class="mb-2">
                    <label for="new_password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm New Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="w-full border border-gray-400 p-2 rounded focus:outline-none focus:border-teal-500" placeholder="Confirm New Password" required>
                </div>
                <div class="mb-6 flex items-center justify-center">
                    <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                </div>
            </form>
    
            <div class="mt-4 text-center shrink-0 snap-center md:w-fit w-full">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Logout</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
