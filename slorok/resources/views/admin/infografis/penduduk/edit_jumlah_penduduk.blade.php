@extends('layouts.admin')

@section('title', 'Update Jumlah Penduduk')

@section('content')
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-2">Update Data Jumlah Penduduk</h1>
        <p class="text-center text-gray-500 dark:text-gray-400 mb-6">Masukkan jumlah penduduk terbaru.</p>

        <div id="form-pesan" class="hidden p-4 mb-4 text-sm rounded-lg" role="alert"></div>

        <form>
            <div class="space-y-6">
                <div>
                    <label for="laki_laki_form" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Laki-laki</label>
                    <div class="mt-1">
                        <input type="number" name="laki_laki" id="laki_laki_form" class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="Memuat data...">
                    </div>
                </div>
                <div>
                    <label for="perempuan_form" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Perempuan</label>
                    <div class="mt-1">
                        <input type="number" name="perempuan" id="perempuan_form" class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="Memuat data...">
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700 flex justify-end items-center gap-x-4">
                <a href="{{ route('admin.infografis.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Batal</a>
                <button type="submit" id="simpan-perubahan-penduduk" class="px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        {{-- Panggil skrip editor khusus untuk halaman ini --}}
        <script type="module" src="{{ asset('assets/js/admin-penduduk-editor.js') }}"></script>
    @endpush
@endsection