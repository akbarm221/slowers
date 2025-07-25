<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start mb-16">
        <div class="lg:col-span-1 text-center lg:text-left">
            <h2 class="text-3xl lg:text-4xl font-bold text-black dark:text-white mb-2">
                APBD Desa <span id="display-tahun-apbd">....</span>
            </h2>
            <p class="text-gray-500 dark:text-gray-400">
                Ringkasan Anggaran Pendapatan dan Belanja Desa.
            </p>
        </div>

        {{-- Dropdown untuk memilih tahun --}}
        <div class="lg:col-span-2 flex justify-center lg:justify-end">
             <div>
                <label for="tahun-apbd-select" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tampilkan Data Tahun:</label>
                <select id="tahun-apbd-select" class="w-full md:w-auto mt-1 rounded-md border-gray-300 dark:border-gray-600 shadow-sm bg-white dark:bg-gray-800 focus:border-primary-500 focus:ring-primary-500">
                    <option>Memuat...</option>
                </select>
            </div>
        </div>

        {{-- Kartu Pendapatan & Belanja --}}
        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
                    <div class="flex items-center text-sm font-semibold text-gray-500 dark:text-gray-400">
                        <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                        Total Pendapatan
                    </div>
                    <p id="display-total-pendapatan" class="mt-2 text-2xl font-bold text-green-500">Rp0</p>
                </div>
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
                    <div class="flex items-center text-sm font-semibold text-gray-500 dark:text-gray-400">
                        <i class="fas fa-arrow-down text-red-500 mr-2"></i>
                        Total Belanja
                    </div>
                    <p id="display-total-belanja" class="mt-2 text-2xl font-bold text-red-500">Rp0</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-16 border-gray-200 dark:border-gray-700" />

    {{-- Grafik Detail (Tidak berubah) --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-semibold text-center">Detail Pendapatan Desa</h3>
            <div class="h-96"><canvas id="pendapatanDetailChart"></canvas></div>
        </div>
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-semibold text-center">Detail Belanja Desa</h3>
            <div class="h-96"><canvas id="belanjaDetailChart"></canvas></div>
        </div>
    </div>
    
        
{{-- Tombol Aksi Create & Update --}}
<div class="mt-12 text-center space-y-4 md:space-y-0 md:space-x-4">
    {{-- PERBAIKAN PADA href --}}
    <a href="{{ route('admin.infografis.apbd.create') }}" class="inline-block px-8 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700">
        <i class="fas fa-plus mr-2"></i>
        Tambah Data APBD Baru
    </a>
    
    {{-- PERBAIKAN PADA href --}}
    <a href="#" id="update-apbd-button" class="inline-block px-8 py-3 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700">
        <i class="fas fa-edit mr-2"></i>
        Update Data Tahun <span id="update-apbd-button-year">...</span>
    </a>
</div>
</div>