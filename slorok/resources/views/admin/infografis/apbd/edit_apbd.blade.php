@extends('layouts.admin')
@section('title', 'Update Data APBD')

@section('content')
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-2">Update Data APBD Tahun {{ $tahun }}</h1>
        <p class="text-center text-gray-500 dark:text-gray-400 mb-6">Ubah rincian pendapatan dan belanja untuk tahun yang dipilih.</p>
        <div id="form-pesan" class="hidden p-4 mb-4 text-sm rounded-lg" role="alert"></div>

        <form id="apbd-form">
            <input type="hidden" id="tahun" value="{{ $tahun }}">
            {{-- Rincian Pendapatan --}}
            <h3 class="text-lg font-semibold mt-6 border-b pb-2 mb-4">Rincian Pendapatan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="number" name="pendapatan_asli_desa" placeholder="Pendapatan Asli Desa" class="input-field">
                <input type="number" name="pendapatan_transfer" placeholder="Pendapatan Transfer" class="input-field">
                <input type="number" name="pendapatan_lain_lain" placeholder="Pendapatan Lain-lain" class="input-field">
            </div>

            {{-- Rincian Belanja --}}
            <h3 class="text-lg font-semibold mt-6 border-b pb-2 mb-4">Rincian Belanja</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="number" name="belanja_pemerintahan" placeholder="Belanja Pemerintahan" class="input-field">
                <input type="number" name="belanja_pembangunan" placeholder="Belanja Pembangunan" class="input-field">
                <input type="number" name="belanja_kemasyarakatan" placeholder="Belanja Kemasyarakatan" class="input-field">
                <input type="number" name="belanja_pemberdayaan" placeholder="Belanja Pemberdayaan" class="input-field">
                <input type="number" name="belanja_darurat" placeholder="Belanja Darurat" class="input-field">
            </div>

            <div class="mt-8 pt-5 border-t flex justify-end gap-x-4">
                <a href="{{ route('admin.infografis.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" id="simpan-apbd" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script type="module" src="{{ asset('assets/js/admin-apbd-editor.js') }}"></script>
    @endpush
@endsection

@push('styles')
<style>
    .input-field { @apply mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500; }
    .btn-primary { @apply px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700; }
    .btn-secondary { @apply px-4 py-2 bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300; }
</style>
@endpush