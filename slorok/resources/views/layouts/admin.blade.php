<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin Dashboard - Desa Slorok')</title>

    {{-- Aset CSS & JS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    {{-- Konfigurasi Tailwind --}}
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
<body class="font-poppins bg-gray-100 dark:bg-gray-900">

    <x-layout.navbarAdmin />

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 w-full">
        @yield('content')
    </main>
    
    <script src="{{ asset('assets/js/common.js') }}"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            const darkModeToggle = document.getElementById("darkModeToggle");
            const darkModeContainer = document.getElementById('darkModeToggleContainer');
            if(darkModeToggle && darkModeContainer) {
                darkModeContainer.appendChild(darkModeToggle);
            }
        });
    </script>
</body>
</html>