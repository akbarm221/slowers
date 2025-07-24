<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $site['title'] ?? 'Desa Slorok' }} - @yield('title')</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


  {{-- TAMBAHKAN BARIS INI --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            poppins: ["Poppins", "sans-serif"],
          },
          colors: {
            primary: {
              50: "#f0f9f0",
              100: "#dcf2dc",
              200: "#bce5bc",
              300: "#8dd18d",
              400: "#4caf50",
              500: "#2e7d32",
              600: "#1b5e20",
              700: "#174e1a",
              800: "#153f17",
              900: "#133515",
            },
            accent: "#ff6b35",
          },
        },
      },
      darkMode: "class",
    };
  </script>
</head>

<body class="font-poppins bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">

  <div id="loading"
    class="fixed inset-0 bg-white dark:bg-gray-900 flex flex-col justify-center items-center z-50 transition-opacity duration-500">
    <div class="w-12 h-12 border-4 border-gray-200 border-t-primary-500 rounded-full animate-spin mb-4"></div>
    <p class="text-gray-600 dark:text-gray-300">Memuat...</p>
  </div>

  <x-layout.header />

  <main class="pt-16">
    @yield('content')
  </main>

  <x-layout.footer  />

  <script src="{{ asset('assets/js/common.js') }}"></script>
  @stack('scripts') {{-- Tempat untuk script khusus per halaman --}}

</body>

</html>