@extends('layouts.admin')

@section('title', 'Update Data Agama')

@section('content')
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-2">Update Statistik Berdasarkan Agama</h1>
        <p class="text-center text-gray-500 dark:text-gray-400 mb-6">Masukkan jumlah jiwa terbaru untuk setiap agama.</p>

        <div id="form-pesan" class="hidden p-4 mb-4 text-sm rounded-lg" role="alert"></div>

        <form id="agama-form">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="form-islam" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Islam</label>
                    <input type="number" name="islam" id="form-islam" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="form-kristen" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kristen</label>
                    <input type="number" name="kristen" id="form-kristen" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="form-katolik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Katolik</label>
                    <input type="number" name="katolik" id="form-katolik" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="form-hindu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hindu</label>
                    <input type="number" name="hindu" id="form-hindu" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="form-buddha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buddha</label>
                    <input type="number" name="buddha" id="form-buddha" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                 <div>
                    <label for="form-konghucu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Konghucu</label>
                    <input type="number" name="konghucu" id="form-konghucu" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                 <div>
                    <label for="form-lainnya" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kepercayaan Lainnya</label>
                    <input type="number" name="lainnya" id="form-lainnya" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="form-aliran_kepercayaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Aliran Kepercayaan</p>
                    <input type="number" name="aliran_kepercayaan" id="form-aliran_kepercayaan" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
            </div>

            <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700 flex justify-end items-center gap-x-4">
                <a href="{{ route('admin.infografis.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Batal</a>
                <button type="submit" id="simpan-perubahan-agama" class="px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script type="module" src="{{ asset('assets/js/admin-agama-editor.js') }}"></script>
    @endpush
@endsection