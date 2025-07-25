@extends('layouts.admin')

@section('title', 'Infografis Dashboard')

@section('content')
    {{-- Konten di bawah ini adalah salinan dari infografis.html --}}
    <div
        class="bg-gradient-to-r from-primary-600 to-primary-700 text-white py-12 px-4 rounded-lg shadow-lg text-center mb-8">
        <h1 class="text-3xl font-bold">Data Statistik Desa</h1>
        <p class="text-lg mt-2 opacity-90">Visualisasi data dan informasi desa dalam bentuk grafik.</p>
    </div>

    <section class="py-6">
        <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
            <button data-target="#content-kependudukan"
                class="tab-button w-40 h-40 flex flex-col items-center justify-center font-semibold rounded-lg shadow-md bg-primary-600 text-white">
                <img src="{{ asset('assets/img/Penduduk.png') }}" alt="Kependudukan" class="mb-2 w-10 h-10" />
                <span class="text-center">Data Penduduk</span>
            </button>
            <button data-target="#content-pertanian"
                class="tab-button w-40 h-40 flex flex-col items-center justify-center font-semibold rounded-lg shadow-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-100">
                <img src="{{ asset('assets/img/farmer.png') }}" alt="Pertanian" class="mb-2 w-10 h-10" />
                <span class="text-center leading-tight">Data Potensi<br />Pertanian</span>
            </button>
            <button data-target="#content-apbd"
                class="tab-button w-40 h-40 flex flex-col items-center justify-center font-semibold rounded-lg shadow-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-100">
                <img src="{{ asset('assets/img/money.png') }}" alt="APBD Desa" class="mb-2 w-10 h-10" />
                <span class="text-center dark:text-white">Data APBD Desa</span>
            </button>
        </div>
    </section>

    <div id="dynamic-content-area" class="pb-16">
        <div id="content-kependudukan" class="tab-content">
            @include('admin.infografis.partials.kependudukan')
        </div>
        <div id="content-pertanian" class="tab-content hidden">
            @include('admin.infografis.partials.pertanian')
        </div>
        <div id="content-apbd" class="tab-content hidden">
            @include('admin.infografis.partials.apbd')
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('assets/js/charts.js') }}"></script>
     <script type="module" src="{{ asset('assets/js/admin-apbd-editor.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/admin-pekerjaan-editor.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/admin-penduduk-editor.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/admin-agama-editor.js') }}"></script>
@endpush