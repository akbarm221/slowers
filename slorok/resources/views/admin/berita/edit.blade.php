@extends('layouts.admin')
@section('title', 'Update Data APBD Tahun ' . $tahun)

@section('content')
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-2">
            Update Data APBD Tahun {{ $tahun }}
        </h1>
        <p class="text-center text-gray-500 dark:text-gray-400 mb-6">
            Ubah rincian pendapatan dan belanja untuk tahun yang dipilih.
        </p>
        <div id="form-pesan" class="hidden p-4 mb-4 text-sm rounded-lg" role="alert"></div>

        <form id="apbd-form">
            {{-- Input tersembunyi untuk menyimpan tahun yang sedang diedit --}}
            <input type="hidden" id="tahun" value="{{ $tahun }}">

            {{-- Rincian Pendapatan --}}
            <h3 class="text-lg font-semibold mt-6 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                Rincian Pendapatan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="pendapatan_asli_desa" class="block text-sm font-medium">Pendapatan Asli Desa</label>
                    <input type="number" name="pendapatan_asli_desa" id="pendapatan_asli_desa" placeholder="0" class="input-field">
                </div>
                <div>
                    <label for="pendapatan_transfer" class="block text-sm font-medium">Pendapatan Transfer</label>
                    <input type="number" name="pendapatan_transfer" id="pendapatan_transfer" placeholder="0" class="input-field">
                </div>
                <div>
                    <label for="pendapatan_lain_lain" class="block text-sm font-medium">Pendapatan Lain-lain</label>
                    <input type="number" name="pendapatan_lain_lain" id="pendapatan_lain_lain" placeholder="0" class="input-field">
                </div>
            </div>

            {{-- Rincian Belanja --}}
            <h3 class="text-lg font-semibold mt-6 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                Rincian Belanja
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="belanja_pemerintahan" class="block text-sm font-medium">Belanja Pemerintahan</label>
                    <input type="number" name="belanja_pemerintahan" id="belanja_pemerintahan" placeholder="0" class="input-field">
                </div>
                <div>
                    <label for="belanja_pembangunan" class="block text-sm font-medium">Belanja Pembangunan</label>
                    <input type="number" name="belanja_pembangunan" id="belanja_pembangunan" placeholder="0" class="input-field">
                </div>
                 <div>
                    <label for="belanja_kemasyarakatan" class="block text-sm font-medium">Belanja Kemasyarakatan</label>
                    <input type="number" name="belanja_kemasyarakatan" id="belanja_kemasyarakatan" placeholder="0" class="input-field">
                </div>
                 <div>
                    <label for="belanja_pemberdayaan" class="block text-sm font-medium">Belanja Pemberdayaan</label>
                    <input type="number" name="belanja_pemberdayaan" id="belanja_pemberdayaan" placeholder="0" class="input-field">
                </div>
                 <div>
                    <label for="belanja_darurat" class="block text-sm font-medium">Belanja Darurat</label>
                    <input type="number" name="belanja_darurat" id="belanja_darurat" placeholder="0" class="input-field">
                </div>
            </div>

            <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-x-4">
                <a href="{{ route('admin.infografis.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" id="simpan-apbd" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
    @push('scripts')
        {{-- Memanggil skrip yang sama, karena skrip ini menangani logika form juga --}}
        <script type="module" src="{{ asset('assets/js/admin-apbd-editor.js') }}"></script>
    @endpush
@endsection

@push('styles')
{{-- Style khusus untuk halaman ini agar rapi --}}
<style>
    .input-field { @apply mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500; }
    .btn-primary { @apply px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700; }
    .btn-secondary { @apply px-4 py-2 bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300; }
</style>
@endpush