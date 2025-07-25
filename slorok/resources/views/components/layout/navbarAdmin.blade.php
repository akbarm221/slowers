<header class="bg-white dark:bg-gray-800 shadow-md w-full sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Desa" class="w-10 h-10 rounded-full mr-3" />
                <span class="text-lg font-semibold text-primary-600 dark:text-primary-400">Admin Panel</span>
            </div>

            <nav class="hidden md:flex md:space-x-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center
                   {{ request()->routeIs('admin.dashboard') ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Infografis
                </a>
                {{-- Nanti 4 menu lainnya bisa ditambahkan di sini --}}
                {{-- <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">Menu 2</a> --}}
            </nav>

            <div class="flex items-center">
                <div id="darkModeToggleContainer" class="mr-2">
                    {{-- Placeholder ini akan diisi oleh common.js --}}
                </div>
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium
               {{ request()->routeIs('admin.dashboard') ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
               Infografis
            </a>
            {{-- Nanti 4 menu mobile lainnya bisa ditambahkan di sini --}}
        </div>
    </div>
</header>