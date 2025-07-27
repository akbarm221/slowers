@extends('layouts.admin')
@section('title', 'Tambah Berita Baru')

@section('content')
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Tambah Berita Baru</h1>
        <div id="form-pesan" class="hidden p-4 mb-4 text-sm rounded-lg" role="alert"></div>

        {{-- PERUBAHAN PENTING: Hapus action dan method dari form --}}
        <form id="berita-form" data-id="">
            <div class="space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-medium">Judul Berita</label>
                    <input type="text" name="judul" id="judul" class="input-field" required>
                </div>
                <div>
                    <label for="isi" class="block text-sm font-medium">Isi Berita</label>
                    <textarea name="isi" id="isi" rows="10" class="input-field"></textarea>
                </div>
                <div>
                    <label for="gambar" class="block text-sm font-medium">Upload Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" required>
                    <div id="upload-progress" class="hidden mt-2 w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div id="progress-bar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-x-4">
                <a href="{{ route('admin.berita.index') }}" class="btn-secondary">Batal</a>
                <button type="button" id="simpan-berita" class="btn-primary">Simpan Berita</button>
            </div>
        </form>
    </div>
@endsection

@push('styles')
<style>
    .input-field { @apply mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500; }
    .btn-primary { @apply px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700 disabled:opacity-50 disabled:cursor-wait; }
    .btn-secondary { @apply px-4 py-2 bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300; }
</style>
@endpush

@push('scripts')
    {{-- Memanggil skrip manager yang akan menangani form ini --}}
    <script type="module" src="{{ asset('assets/js/admin-berita-manager.js') }}"></script>
@endpush