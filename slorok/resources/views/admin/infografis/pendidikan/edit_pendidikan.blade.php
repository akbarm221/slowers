@extends('layouts.admin')
@section('title', 'Update Data Pendidikan')

@section('content')
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-2">Update Statistik Berdasarkan Pendidikan</h1>
        <p class="text-center text-gray-500 dark:text-gray-400 mb-6">Masukkan jumlah jiwa terbaru untuk setiap tingkat pendidikan.</p>

        <div id="form-pesan" class="hidden p-4 mb-4 text-sm rounded-lg" role="alert"></div>

        <form id="pendidikan-form">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- Daftar input sesuai dengan field di Firestore --}}
                <div>
                    <label for="tidak_sekolah" class="block text-sm font-medium">Tidak/Belum Sekolah</label>
                    <input type="number" name="tidak_sekolah" id="tidak_sekolah" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="belum_tamat_sd" class="block text-sm font-medium">Belum Tamat SD/Sederajat</label>
                    <input type="number" name="belum_tamat_sd" id="belum_tamat_sd" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="tamat_sd" class="block text-sm font-medium">Tamat SD/Sederajat</label>
                    <input type="number" name="tamat_sd" id="tamat_sd" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="sltp" class="block text-sm font-medium">SLTP/Sederajat</label>
                    <input type="number" name="sltp" id="sltp" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="slta" class="block text-sm font-medium">SLTA/Sederajat</label>
                    <input type="number" name="slta" id="slta" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="d1_d2" class="block text-sm font-medium">Diploma I/II</label>
                    <input type="number" name="d1_d2" id="d1_d2" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="d3" class="block text-sm font-medium">Akademi/Diploma III/S. Muda</label>
                    <input type="number" name="d3" id="d3" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="d4_s1" class="block text-sm font-medium">Diploma IV/Strata I</label>
                    <input type="number" name="d4_s1" id="d4_s1" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="s2" class="block text-sm font-medium">Strata II</label>
                    <input type="number" name="s2" id="s2" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
                <div>
                    <label for="s3" class="block text-sm font-medium">Strata III</label>
                    <input type="number" name="s3" id="s3" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" placeholder="0">
                </div>
            </div>

            <div class="mt-8 pt-5 border-t flex justify-end items-center gap-x-4">
                <a href="{{ route('admin.infografis.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Batal</a>
                <button type="submit" id="simpan-perubahan-pendidikan" class="px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script type="module" src="{{ asset('assets/js/admin-pendidikan-editor.js') }}"></script>
    @endpush
@endsection