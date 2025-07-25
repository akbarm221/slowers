<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard - Desa Slorok')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { poppins: ["Poppins", "sans-serif"] },
                    colors: {
                        primary: { 50: "#f0f9f0", 100: "#dcf2dc", 200: "#bce5bc", 300: "#8dd18d", 400: "#4caf50", 500: "#2e7d32", 600: "#1b5e20", 700: "#174e1a", 800: "#153f17", 900: "#133515" },
                        accent: "#ff6b35",
                        blue: "#1976D2",
                    },
                },
            },
            darkMode: "class",
        };
    </script>
</head>
<body class="font-poppins bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">

    <div class="flex h-screen">
      <x-layout.sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white dark:bg-gray-800 shadow-sm flex items-center justify-between p-4 border-b dark:border-gray-700">
                <button id="sidebar-toggle" class="md:hidden text-gray-600 dark:text-gray-300 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-semibold text-gray-800 dark:text-white ml-2 md:ml-0">@yield('page-title')</h1>
                <div id="darkModeToggleContainer">
                    {{-- Placeholder untuk tombol dark mode dari common.js --}}
                </div>
            </header>
            
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>
    
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden md:hidden"></div>


    <a href="/logout"></a>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script>
        // Logika untuk sidebar responsif
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const overlay = document.getElementById('sidebar-overlay');

            const toggleSidebar = () => {
                sidebar.classList.toggle('hidden');
                overlay.classList.toggle('hidden');
            };

            sidebarToggle.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Integrasi Tombol Dark Mode dari common.js
            const darkModeToggle = document.getElementById("darkModeToggle");
            if(darkModeToggle) {
                document.getElementById('darkModeToggleContainer').appendChild(darkModeToggle);
            }
        });
    </script>
    @stack('scripts')

    
</body>
</html>