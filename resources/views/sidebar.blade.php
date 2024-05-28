<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    {{-- please don't change this tailwindCSS CDN below --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/c9a949b192.js" crossorigin="anonymous"></script>

    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .sidebar-visible {
            transform: translateX(0);
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
            display: none;
            pointer-events: none; /* Allow clicks to pass through */
        }
        .overlay-visible {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans cursor-default">

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar bg-teal-800 w-64 fixed top-0 left-0 h-screen flex-shrink-0 text-white md:relative md:sidebar-visible z-20">
        <div class="h-screen flex flex-col justify-between">
            <div class="p-4">
                <h1 class="text-2xl font-semibold mb-4 text-white flex items-center">
                    <img src="{{ asset('/logo_CashierPro.png') }}" alt="Logo" class="w-8 h-8 mr-2" />
                    CashierPro
                </h1>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="/" class="flex items-center py-2 px-4 rounded-lg transition-all duration-300 hover:bg-teal-700">
                                <i class="fas fa-shopping-cart fa-fw mr-2"></i>
                                Transaction
                            </a>
                        </li>
                        <li>
                            <a href="/addInventory" class="flex items-center py-2 px-4 rounded-lg transition-all duration-300 hover:bg-teal-700">
                                <i class="fas fa-box fa-fw mr-2"></i>
                                Inventory
                            </a>
                        </li>
                        <li>
                            <a href="/viewHistoryPage" class="flex items-center py-2 px-4 rounded-lg transition-all duration-300 hover:bg-teal-700">
                                <i class="fas fa-history fa-fw mr-2"></i>
                                Order History
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="p-4">
                <p class="text-center text-xs text-gray-400">&copy; 2024 CashierPro</p>
            </div>
        </div>
    </div>

    <div id="overlay" class="overlay md:hidden"></div>

    <div id="toggleSidebarButton" class="absolute left-0 top-[50%] md:hidden bg-teal-700 py-3 px-5 rounded-tr-full rounded-br-full z-20">
        <button id="toggleSidebarButton"><i class="fa-solid fa-chevron-right text-white"></i></button>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const divbutton = document.getElementById('divbutton');
        const toggleButton = document.getElementById('toggleSidebarButton');
        const overlay = document.getElementById('overlay');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-hidden');
            overlay.classList.toggle('overlay-visible');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('sidebar-hidden');
            overlay.classList.remove('overlay-visible');
            // Hide sidebar on load for smaller screens
            if (window.innerWidth < 768) {
                sidebar.classList.add('sidebar-hidden');
            } else {
                sidebar.classList.remove('sidebar-hidden');
            }
        });

    </script>

</body>
</html>
