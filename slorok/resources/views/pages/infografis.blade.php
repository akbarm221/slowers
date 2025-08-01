<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Infografis - Desa Slorok</title>

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
              blue: "#1976D2",
            },
          },
        },
        darkMode: "class",
      };
    </script>
    <style>
      .tab-button {
        transition: all 0.3s ease-in-out;
      }
    </style>
  </head>
  <body
    class="font-poppins bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white transition-colors duration-300"
  >
    <header
      class="fixed top-0 left-0 w-full h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 z-40 transition-colors duration-300"
    >
      <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between"
      >
        <div class="flex items-center space-x-3">
          <img
            src="{{ asset('assets/img/logo.png') }}"
            alt="Logo Desa"
            class="w-10 h-10 rounded-full"
          />
          <span
            class="text-lg font-semibold text-primary-600 dark:text-primary-400"
            >Desa Slorok</span
          >
        </div>

        <nav class="hidden md:block">
          <ul class="flex space-x-8">
            <li>
              <a
                href="{{ url('/') }}"
                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all duration-200"                
              >
                <i class="fas fa-home"></i>
                <span>Beranda</span>
              </a>
            </li>
            <li>
              <a
                href="{{ url('/profil') }}"
                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all duration-200"
              >
                <i class="fas fa-info-circle"></i>
                <span>Profile Desa</span>
              </a>
            </li>
            <li>
              <a
                href="{{ url('/infografis') }}"
                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-primary-600 bg-primary-50 dark:bg-primary-900/20 transition-all duration-200"
              >
                <i class="fas fa-chart-bar"></i>
                <span>Infografis</span>
              </a>
            </li>
            <li>
              <a
                href="{{ url('/layanan') }}"
                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all duration-200"
              >
                <i class="fas fa-cogs"></i>
                <span>Layanan</span>
              </a>
            </li>
            <li>
              <a
                href="{{ url('/bumdes') }}"
                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all duration-200"
              >
                <i class="fas fa-store"></i>
                <span>bumdes</span>
              </a>
            </li>
          </ul>
        </nav>

        <div class="flex items-center space-x-4">
          <button
            id="darkModeToggle"
            class="w-10 h-10 rounded-full border border-gray-300 dark:border-gray-600 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:text-primary-600 hover:border-primary-600 transition-all duration-200"
          >
            <i class="fas fa-moon"></i>
          </button>
          <button
            class="md:hidden w-10 h-10 flex flex-col justify-center items-center space-y-1"
            id="mobileMenuToggle"
          >
            <span
              class="w-6 h-0.5 bg-gray-600 dark:bg-gray-300 transition-all duration-300"
            ></span>
            <span
              class="w-6 h-0.5 bg-gray-600 dark:bg-gray-300 transition-all duration-300"
            ></span>
            <span
              class="w-6 h-0.5 bg-gray-600 dark:bg-gray-300 transition-all duration-300"
            ></span>
          </button>
        </div>
      </div>

      <nav
        id="mobileMenu"
        class="md:hidden hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700"
      >
        <ul class="px-4 py-2 space-y-1">
          <li>
            <a
              href="{{ url('/') }}"
              class="flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200"
            >
              <i class="fas fa-home w-5"></i>
              <span>Beranda</span>
            </a>
          </li>
          <li>
            <a
              href="{{ url('/profil') }}"
              class="flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200"
            >
              <i class="fas fa-info-circle w-5"></i>
              <span>Profile Desa</span>
            </a>
          </li>
          <li>
            <a
              href="{{ url('/infografis') }}"
              class="flex items-center space-x-3 px-3 py-3 rounded-lg text-primary-600 bg-primary-50 dark:bg-primary-900/20 transition-colors duration-200"
            >
              <i class="fas fa-chart-bar w-5"></i>
              <span>Infografis</span>
            </a>
          </li>
          <li>
            <a
              href="{{ url('/layanan') }}"
              class="flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200"
            >
              <i class="fas fa-cogs w-5"></i>
              <span>Layanan</span>
            </a>
          </li>
          <li>
            <a
              href="{{ url('/bumdes') }}"
              class="flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200"
            >
              <i class="fas fa-store w-5"></i>
              <span>Bumdes</span>
            </a>
          </li>
        </ul>
      </nav>
    </header>

    <main class="pt-16 min-h-screen">
      <section
        class="bg-gradient-to-r from-primary-600 to-primary-700 text-white py-24"
      >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h1 class="text-4xl font-bold mb-4">Data Statistik Desa</h1>
          <p class="text-xl opacity-90">
            Visualisasi data dan informasi desa dalam bentuk grafik
          </p>
        </div>
      </section>

      <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div
            class="flex flex-col sm:flex-row justify-center items-center gap-6"
          >
            <button
              data-target="#content-kependudukan"
              class="tab-button w-40 h-40 flex flex-col items-center justify-center font-semibold rounded-lg shadow-md bg-primary-600 text-white"
            >
              <img
                src="{{ asset('assets/img/Penduduk.png') }}"
                alt="Kependudukan"
                class="mb-2 w-10 h-10"
              />
              <span class="text-center">Data Penduduk</span>
            </button>
            <button
              data-target="#content-pertanian"
              class="tab-button w-40 h-40 flex flex-col items-center justify-center font-semibold rounded-lg shadow-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-100"
            >
              <img
                src="{{ asset('assets/img/farmer.png') }}"
                alt="Pertanian"
                class="mb-2 w-10 h-10"
              />
              <span class="text-center leading-tight"
                >Data Potensi<br />Pertanian</span
              >
            </button>
            <button
              data-target="#content-apbd"
              class="tab-button w-40 h-40 flex flex-col items-center justify-center font-semibold rounded-lg shadow-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-100"
            >
              <img
                src="{{ asset('assets/img/money.png') }}"
                alt="APBD Desa"
                class="mb-2 w-10 h-10"
              />
              <span class="text-center dark:text-white">Data APBD Desa</span>
            </button>
          </div>
        </div>
      </section>
      <div id="dynamic-content-area" class="pb-16">
        <div id="content-kependudukan" class="tab-content">
          <section class="mb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-black dark:text-white">
                  Jumlah Penduduk
                </h2>
              </div>
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div
                  class="lg:col-span-2 bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg flex items-center justify-center space-x-6"
                >
                  <div class="flex-shrink-0">
                    <i
                      class="fas fa-people-arrows text-blue"
                      style="font-size: 48px"
                    ></i>
                  </div>
                  <div>
                    <p
                      class="text-base font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                    >
                      Total Penduduk
                    </p>
                    <p class="text-4xl font-bold text-black dark:text-white">
                      <span
                        class="text-black animate-number dark:text-white"
                        data-value="8598"
                        >0</span
                      >
                      Jiwa
                    </p>
                  </div>
                </div>
                <div
                  class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg flex items-center space-x-6"
                >
                  <div class="flex-shrink-0">
                    <i
                      class="fas fa-person-dress text-blue"
                      style="font-size: 48px"
                    ></i>
                  </div>
                  <div>
                    <p
                      class="text-base font-semibold text-black dark:text-gray-400 uppercase tracking-wider"
                    >
                      Perempuan
                    </p>
                    <p class="text-4xl font-bold text-black dark:text-white">
                      <span
                        class="text-black animate-number dark:text-white"
                        data-value="4281"
                        >0</span
                      >
                      Jiwa
                    </p>
                  </div>
                </div>
                <div
                  class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg flex items-center space-x-6"
                >
                  <div class="flex-shrink-0">
                    <i
                      class="fas fa-person text-blue"
                      style="font-size: 48px"
                    ></i>
                  </div>
                  <div>
                    <p
                      class="text-base font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                    >
                      Laki-laki
                    </p>
                    <p class="text-4xl font-bold text-black dark:text-white">
                      <span
                        class="text-black animate-number dark:text-white"
                        data-value="4317"
                        >0</span
                      >
                      Jiwa
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="mb-16 bg-white dark:bg-gray-900 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="text-center mb-12">
                <h2
                  class="text-3xl font-bold text-gray-800 dark:text-white mb-4"
                >
                  Statistik Berdasarkan Agama
                </h2>
              </div>
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                  class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center"
                >
                  <i
                    class="fas fa-mosque text-blue mt-2 mb-6"
                    style="font-size: 40px"
                  ></i>
                  <p
                    class="text-4xl font-extrabold text-gray-900 dark:text-white animate-number"
                    data-value="1148"
                  >
                    0
                  </p>
                  <p
                    class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300"
                    data-value="8285"
                  >
                    Islam
                  </p>
                  <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
                </div>
                <div
                  class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center"
                >
                  <i
                    class="fas fa-church text-blue mt-2 mb-6"
                    style="font-size: 40px"
                  ></i>
                  <p
                    class="text-4xl font-extrabold text-gray-900 dark:text-white animate-number"
                    data-value="22"
                  >
                    0
                  </p>
                  <p
                    class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300"
                  >
                    Kristen
                  </p>
                  <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
                </div>
                <div
                  class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center"
                >
                  <i
                    class="fas fa-bible text-blue mt-2 mb-6"
                    style="font-size: 40px"
                  ></i>
                  <p
                    class="text-4xl font-extrabold text-gray-900 dark:text-white animate-number"
                    data-value="268"
                  >
                    0
                  </p>
                  <p
                    class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300"
                    data-value="23"
                  >
                    Katolik
                  </p>
                  <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
                </div>
                <div
                  class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center"
                >
                  <i
                    class="fas fa-om text-blue mt-2 mb-6"
                    style="font-size: 40px"
                  ></i>
                  <p
                    class="text-4xl font-extrabold text-gray-900 dark:text-white animate-number"
                    data-value="23"
                  >
                    0
                  </p>
                  <p
                    class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300"
                  >
                    Hindu
                  </p>
                  <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
                </div>
                <div
                  class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center"
                >
                  <i
                    class="fas fa-dharmachakra text-blue mt-2 mb-6"
                    style="font-size: 40px"
                  ></i>
                  <p
                    class="text-4xl font-extrabold text-gray-900 dark:text-white animate-number"
                    data-value="0"
                  >
                    0
                  </p>
                  <p
                    class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300"
                  >
                    Buddha
                  </p>
                  <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
                </div>
                <div
                  class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center"
                >
                  <i
                    class="fas fa-yin-yang text-blue mt-2 mb-6"
                    style="font-size: 40px"
                  ></i>
                  <p
                    class="text-4xl font-extrabold text-gray-900 dark:text-white animate-number"
                    data-value="0"
                  >
                    0
                  </p>
                  <p
                    class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300"
                  >
                    Konghucu
                  </p>
                  <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
                </div>
                <div
                  class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center"
                >
                  <i
                    class="fas fa-pray text-blue mt-2 mb-6"
                    style="font-size: 40px"
                  ></i>
                  <p
                    class="text-4xl font-extrabold text-gray-900 dark:text-white animate-number"
                    data-value="0"
                  >
                    0
                  </p>
                  <p
                    class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300"
                  >
                    Kepercayaan Lainnya
                  </p>
                  <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
                </div>
                <div
                  class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center"
                >
                  <i
                    class="fas fa-praying-hands text-blue mt-2 mb-6"
                    style="font-size: 40px"
                  ></i>
                  <p
                    class="text-4xl font-extrabold text-gray-900 dark:text-white animate-number"
                    data-value="0"
                  >
                    0
                  </p>
                  <p
                    class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300"
                  >
                    Aliran Kepercayaan
                  </p>
                  <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
                </div>
              </div>
            </div>
          </section>

          <section class="py-16 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="text-center mb-4">
                <h2
                  class="text-3xl font-bold text-black mb-4 text-black dark:text-white"
                >
                  Berdasarkan Pekerjaan
                </h2>
              </div>
              <div class="flex justify-center mb-8 gap-2 pt-12">
                <button
                  class="filter-btn-pekerjaan bg-blue active:bg-blue text-white px-4 py-2 rounded-lg shadow"
                >
                  Semua
                </button>
                <button
                  class="filter-btn-pekerjaan bg-white active:bg-blue dark:bg-gray-700 px-4 py-2 rounded-lg shadow"
                >
                  Laki-laki
                </button>
                <button
                  class="filter-btn-pekerjaan bg-white active:bg-blue dark:bg-gray-700 px-4 py-2 rounded-lg shadow"
                >
                  Perempuan
                </button>
              </div>

              <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div
                  class="lg:col-span-1 bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg"
                >
                  <div
                    class="flex items-center bg-blue text-white p-3 rounded-t-lg"
                  >
                    <span class="font-semibold flex-1">Jenis Pekerjaan</span>
                    <span class="font-semibold text-right">Jumlah</span>
                  </div>
                  <div
                    id="tabel-pekerjaan-container"
                    class="max-h-96 overflow-y-auto"
                  ></div>
                </div>

                <div
                  id="kartu-pekerjaan-container"
                  class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"
                ></div>
              </div>
            </div>
          </section>

          <section>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-black dark:text-white">
                  Berdasarkan Pendidikan
                </h2>
              </div>
              <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
                <div class="overflow-x-auto">
                  <div class="relative h-96" style="min-width: 800px">
                    <canvas id="pendidikanChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>

        <div id="content-pertanian" class="tab-content hidden">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
              <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
                <h3
                  class="text-xl font-bold text-center text-gray-800 dark:text-white mb-4"
                >
                  Data Potensi Peternakan
                </h3>
                <div class="h-80"><canvas id="peternakanChart"></canvas></div>
              </div>
              <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
                <h3
                  class="text-xl font-bold text-center text-gray-800 dark:text-white mb-4"
                >
                  Data Potensi Perkebunan ( Ton )
                </h3>
                <div class="h-80"><canvas id="perkebunanChart"></canvas></div>
              </div>
            </div>
            <div>
              <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
                <h3
                  class="text-xl font-bold text-center text-gray-800 dark:text-white mb-4"
                >
                  Data Potensi Tanaman Pangan
                </h3>
                <div class="overflow-x-auto">
                  <div class="relative h-96" style="min-width: 800px">
                    <canvas id="tanamanPanganChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="content-apbd" class="tab-content hidden">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
              class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center mb-16"
            >
              <div class="lg:col-span-1 text-center lg:text-left">
                <h2
                  class="text-3xl lg:text-4xl font-bold text-black dark:text-white mb-2"
                >
                  APBD Desa 2024
                </h2>
                <p class="text-gray-500 dark:text-gray-400">
                  Ringkasan Anggaran Pendapatan dan Belanja Desa tahun berjalan.
                </p>
              </div>
              <div class="lg:col-span-2">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                  <div
                    class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg"
                  >
                    <div
                      class="flex items-center text-sm font-semibold text-gray-500 dark:text-gray-400"
                    >
                      <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                      Pendapatan
                    </div>
                    <p
                      class="mt-2 text-2xl font-bold text-green-500 animate-number"
                      data-value="2414959700"
                      data-format="currency"
                    >
                      Rp0
                    </p>
                  </div>
                  <div
                    class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg"
                  >
                    <div
                      class="flex items-center text-sm font-semibold text-gray-500 dark:text-gray-400"
                    >
                      <i class="fas fa-arrow-down text-red-500 mr-2"></i>
                      Belanja
                    </div>
                    <p
                      class="mt-2 text-2xl font-bold text-red-500 animate-number"
                      data-value="2776567200"
                      data-format="currency"
                    >
                      Rp0
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-16 border-gray-200 dark:border-gray-700" />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
              <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
                <h3
                  class="text-xl font-semibold text-center text-gray-800 dark:text-white mb-4"
                >
                  Detail Pendapatan Desa
                </h3>
                <div class="h-96">
                  <canvas id="pendapatanDetailChart"></canvas>
                </div>
              </div>
              <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
                <h3
                  class="text-xl font-semibold text-center text-gray-800 dark:text-white mb-4"
                >
                  Detail Belanja Desa
                </h3>
                <div class="h-96">
                  <canvas id="belanjaDetailChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        </div>
    </main>

    <footer
      class="bg-gray-100 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-12"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div
          class="border-t border-gray-200 dark:border-gray-700 pt-8 text-center text-gray-600 dark:text-gray-400"
        >
          <p>
            &copy; 2025 Develop by MMD FILKOM 18 Universitas Brawijaya . Semua
            hak dilindungi.
          </p>
        </div>
      </div>
    </footer>

    <script src="{{ asset('assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script src="{{ asset('assets/js/pekerjaan.js') }}"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
      lucide.createIcons();
    </script>
  </body>
</html>