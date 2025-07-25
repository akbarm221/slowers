@extends('layouts.admin')
@section('title', 'Update Data Pekerjaan')

@section('content')
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-2">Update Data Berdasarkan Pekerjaan</h1>
        <p class="text-center text-gray-500 dark:text-gray-400 mb-8">Pilih jenis pekerjaan dari dropdown, lalu masukkan jumlah terbaru untuk laki-laki dan perempuan.</p>
        
        <div id="form-pesan" class="hidden p-4 mb-4 text-sm rounded-lg" role="alert"></div>

        <form id="pekerjaan-form">
            <div class="space-y-6">
                {{-- Dropdown untuk memilih pekerjaan --}}
                <div>
                    <label for="pekerjaan-dropdown" class="block text-sm font-medium">Jenis Pekerjaan</label>
                    <select id="pekerjaan-dropdown" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                        <option>Memuat daftar pekerjaan...</option>
                    </select>
                </div>
                {{-- Input untuk jumlah laki-laki --}}
                <div>
                    <label for="laki_laki_pekerjaan_form" class="block text-sm font-medium">Jumlah Laki-laki</label>
                    <input type="number" id="laki_laki_pekerjaan_form" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-100 dark:bg-gray-600 rounded-md shadow-sm" placeholder="Pilih pekerjaan dahulu" disabled>
                </div>
                {{-- Input untuk jumlah perempuan --}}
                <div>
                    <label for="perempuan_pekerjaan_form" class="block text-sm font-medium">Jumlah Perempuan</label>
                    <input type="number" id="perempuan_pekerjaan_form" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-100 dark:bg-gray-600 rounded-md shadow-sm" placeholder="Pilih pekerjaan dahulu" disabled>
                </div>
            </div>
            <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700 flex justify-end items-center gap-x-4">
                <a href="{{ route('admin.infografis.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300">
                    Batal
                </a>
                <button type="submit" id="simpan-perubahan-pekerjaan" class="px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-75">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    @push('scripts')
        {{-- Memanggil skrip khusus untuk halaman ini --}}
        <script type="module" src="{{ asset('assets/js/admin-pekerjaan-editor.js') }}"></script>
    @endpush
@endsection