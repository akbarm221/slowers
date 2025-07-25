<section class="mb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-black dark:text-white">
                Jumlah Penduduk
            </h2>
        </div>
        {{-- Tampilan Data Penduduk (Sekarang Dinamis) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div
                class="lg:col-span-2 bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg flex items-center justify-center space-x-6">
                <div class="flex-shrink-0"><i class="fas fa-people-arrows text-blue" style="font-size: 48px"></i></div>
                <div>
                    <p class="text-base font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total
                        Penduduk</p>
                    <p class="text-4xl font-bold text-black dark:text-white">
                        <span id="display-total-penduduk">...</span> Jiwa
                    </p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg flex items-center space-x-6">
                <div class="flex-shrink-0"><i class="fas fa-person-dress text-blue" style="font-size: 48px"></i></div>
                <div>
                    <p class="text-base font-semibold text-black dark:text-gray-400 uppercase tracking-wider">Perempuan
                    </p>
                    <p class="text-4xl font-bold text-black dark:text-white">
                        <span id="display-perempuan">...</span> Jiwa
                    </p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg flex items-center space-x-6">
                <div class="flex-shrink-0"><i class="fas fa-person text-blue" style="font-size: 48px"></i></div>
                <div>
                    <p class="text-base font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Laki-laki</p>
                    <p class="text-4xl font-bold text-black dark:text-white">
                        <span id="display-laki-laki">...</span> Jiwa
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('admin.infografis.penduduk.edit') }}"
                class="inline-block px-8 py-3 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700">
                <i class="fas fa-pencil-alt mr-2"></i>
                Update Data Penduduk
            </a>
        </div>
    </div>
</section>

<section class="mb-16 bg-white dark:bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
                Statistik Berdasarkan Agama
            </h2>
        </div>
        {{-- Kontainer data agama yang akan diisi oleh JS --}}
        <div id="agama-display-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center">
                <i class="fas fa-mosque text-blue mt-2 mb-6" style="font-size: 40px"></i>
                <p id="display-islam" class="text-4xl font-extrabold text-gray-900 dark:text-white">...</p>
                <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">Islam</p>
                <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center">
                <i class="fas fa-church text-blue mt-2 mb-6" style="font-size: 40px"></i>
                <p id="display-kristen" class="text-4xl font-extrabold text-gray-900 dark:text-white">...</p>
                <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">Kristen</p>
                <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center">
                <i class="fas fa-bible text-blue mt-2 mb-6" style="font-size: 40px"></i>
                <p id="display-katolik" class="text-4xl font-extrabold text-gray-900 dark:text-white">...</p>
                <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">Katolik</p>
                <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center">
                <i class="fas fa-om text-blue mt-2 mb-6" style="font-size: 40px"></i>
                <p id="display-hindu" class="text-4xl font-extrabold text-gray-900 dark:text-white">...</p>
                <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">Hindu</p>
                <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center">
                <i class="fas fa-dharmachakra text-blue mt-2 mb-6" style="font-size: 40px"></i>
                <p id="display-buddha" class="text-4xl font-extrabold text-gray-900 dark:text-white">...</p>
                <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">Buddha</p>
                <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center">
                <i class="fas fa-yin-yang text-blue mt-2 mb-6" style="font-size: 40px"></i>
                <p id="display-konghucu" class="text-4xl font-extrabold text-gray-900 dark:text-white">...</p>
                <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">Konghucu</p>
                <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center">
                <i class="fas fa-pray text-blue mt-2 mb-6" style="font-size: 40px"></i>
                <p id="display-lainnya" class="text-4xl font-extrabold text-gray-900 dark:text-white">...</p>
                <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">Kepercayaan Lainnya</p>
                <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center flex flex-col items-center">
                <i class="fas fa-praying-hands text-blue mt-2 mb-6" style="font-size: 40px"></i>
                <p id="display-aliran_kepercayaan" class="text-4xl font-extrabold text-gray-900 dark:text-white">...</p>
                <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">Aliran Kepercayaan</p>
                <p class="text-sm text-gray-400 dark:text-gray-500">Jiwa</p>
            </div>
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('admin.infografis.agama.edit') }}"
                class="inline-block px-8 py-3 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700">
                <i class="fas fa-edit mr-2"></i>
                Update Data Agama
            </a>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-4">
            <h2 class="text-3xl font-bold text-black mb-4 dark:text-white">
                Berdasarkan Pekerjaan
            </h2>
        </div>

        {{-- Tombol Filter --}}
        <div class="flex justify-center mb-8 gap-2 pt-12">
            <button class="filter-btn-pekerjaan bg-blue-600 text-white px-4 py-2 rounded-lg shadow bg-blue" data-filter="semua">
                Semua
            </button>
            <button class="filter-btn-pekerjaan bg-white dark:bg-gray-700 px-4 py-2 rounded-lg shadow" data-filter="laki_laki">
                Laki-laki
            </button>
            <button class="filter-btn-pekerjaan bg-white dark:bg-gray-700 px-4 py-2 rounded-lg shadow " data-filter="perempuan">
                Perempuan
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- PERUBAHAN DI SINI --}}
            <div class="lg:col-span-1">
                {{-- Header Tabel (di luar kotak putih) --}}
                <div class="flex items-center justify-between bg-blue text-white p-3 rounded-t-xl shadow-lg">
                    <span class="font-semibold text-white">Jenis Pekerjaan</span>
                    <span class="font-semibold text-white">Jumlah</span>
                </div>
                {{-- Konten Tabel (di dalam kotak putih) --}}
                <div id="tabel-pekerjaan-container" class="bg-white dark:bg-gray-900 rounded-b-xl shadow-lg max-h-96 overflow-y-auto p-3">
                    <p class="p-4 text-center text-gray-500">Memuat data...</p>
                </div>
            </div>

            {{-- Kartu Kanan (6 Data Teratas) --}}
            <div id="kartu-pekerjaan-container" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                {{-- Kartu akan dirender oleh JavaScript --}}
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('admin.infografis.pekerjaan.edit') }}" class="inline-block px-8 py-3 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700">
                <i class="fas fa-edit mr-2"></i>
                Update Data Pekerjaan
            </a>
        </div>
    </div>
</section>

{{-- ... (setelah <section> pekerjaan) ... --}}
<section>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-black dark:text-white">Berdasarkan Pendidikan</h2>
        </div>
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
            <div class="overflow-x-auto">
                <div class="relative h-96" style="min-width: 800px">
                    <canvas id="pendidikanChart"></canvas>
                </div>
            </div>
        </div>
        {{-- TAMBAHKAN TOMBOL INI --}}
        <div class="mt-8 text-center">
            <a href="{{ route('admin.infografis.pendidikan.edit') }}" class="inline-block px-8 py-3 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700">
                <i class="fas fa-edit mr-2"></i>
                Update Data Pendidikan
            </a>
        </div>
    </div>
</section>