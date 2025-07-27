@extends('layouts.admin')
@section('title', 'Galeri Kegiatan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Galeri Kegiatan</h1>
        <a href="{{ route('admin.berita.create') }}" class="btn-primary">
            <i class="fas fa-plus mr-2"></i>
            Tambah Berita Baru
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
        {{-- "Wadah" ini akan diisi secara dinamis oleh JavaScript --}}
        <div id="berita-container" class="space-y-4">
            <p class="text-center text-gray-500 py-8">Memuat berita...</p>
        </div>
        {{-- Paginasi via JS akan lebih kompleks, untuk sekarang tampilkan semua --}}
    </div>
@endsection

@push('styles')
<style>
    .btn-primary { @apply px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700; }
    .btn-secondary { @apply px-4 py-2 bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300; }
    .btn-danger { @apply px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700; }
</style>
@endpush

@push('scripts')
    {{-- Memanggil skrip manager yang baru --}}
    <script type="module" src="{{ asset('assets/js/admin-berita-manager.js') }}"></script>
@endpush