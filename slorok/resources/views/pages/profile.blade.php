@extends('layouts.app')

@section('title', 'Profil Desa')

@section('content')
    <main class="pt-16 min-h-screen">
        {{-- Hero Banner --}}
        <section class="bg-gradient-to-r from-primary-600 to-primary-700 text-white py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold mb-4">Profil Desa Slorok</h1>
                <p class="text-xl opacity-90">Mengenal lebih dekat desa kami</p>
            </div>
        </section>

        <section class="py-16 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

                {{-- Sejarah Desa --}}
                <div class="bg-white dark:bg-gray-900 p-8 rounded-xl shadow-lg animate-fade-in-up">
                    <h3 class="text-xl font-semibold text-primary-600 dark:text-primary-400 mb-6 flex items-center">
                        <i class="fas fa-history mr-3"></i>
                        Sejarah Desa
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">Desa Slorok, yang berdiri sejak tahun
                        1881, mendapatkan namanya dari sebuah makam dengan pintu "slorokan" yang ditemukan saat pembukaan
                        lahan pertama oleh tujuh pendiri. Desa ini terdiri dari beberapa dusun yang namanya juga memiliki
                        asal-usul unik. Dusun Menjangan Kalung dinamai setelah penampakan gaib seekor menjangan berkalung.
                        Dusun Pucungsari berasal dari nama pohon Pucung, dan Dusun Sumber dinamai karena banyaknya mata air
                        di wilayah tersebut.</p>
                    <p class="text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">Sepanjang sejarahnya, Desa Slorok
                        memegang peranan penting. Pada era pra-kemerdekaan, wilayah Menjangan Kalung menjadi pangkalan
                        pejuang melawan Jepang. Di zaman Belanda, salah satu rumah di Pucungsari Kidul menjadi markas
                        pejuang dan menerima penghargaan dari Legiun Veteran pada tahun 1987. Desa ini juga menjadi lokasi
                        pemberantasan oknum G30S/PKI. Selain itu, desa mengalami beberapa perubahan signifikan, termasuk
                        pemindahan pasar desa pada tahun 1961 dan pengurangan wilayah pada tahun 1971. Kini, Desa Slorok
                        merupakan bagian dari Kecamatan Garum.</p>
                    <p class="text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">Tujuh Pendiri Desa Slorok:<br>1. Darma
                        Wangsa (Makam di Dusun Menjangankalung)<br>2. Raden Subroto (Makam di Dusun Pucungsari Kidul)<br>3.
                        Merto Yudho (Makam di Dusun Slorok)<br>4. Dewi Dukimat (Makam di Dusun Sumber)<br>5. Tunggul Wulung
                        (Makam di Dusun Sumber)<br>6. Belum diketahui<br>7. Belum diketahui</p>
                </div>

                {{-- Slider Sejarah Kepala Desa --}}
                <div class="bg-white dark:bg-gray-900 p-8 rounded-xl shadow-lg animate-fade-in-up">
                    <h3 class="text-xl font-semibold text-primary-600 dark:text-primary-400 mb-6 flex items-center">
                        <i class="fas fa-crown mr-3"></i>
                        Sejarah Kepala Desa
                    </h3>
                    @php
                        $leaders = [
                            ['name' => 'Kromosonto', 'period' => '1873-1885', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Diposentono', 'period' => '1885-1906', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Kasanrodjo', 'period' => '1906-1922', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Kromowitjono', 'period' => '1922-1929', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Kromosentono', 'period' => '1929-1931', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Kartosemito', 'period' => '1931-1933', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Sastrosoerono', 'period' => '1933-1947', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Tomopawiro', 'period' => '1947-1988', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Habib Suminto (Pj.)', 'period' => '1988-1989', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'H. Imam Bachrodin', 'period' => '1988-1997', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'JFR. Suyatin (Pj.)', 'period' => '1997-1998', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'H. Imam Bachrodin', 'period' => '1998-2003', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Muryani (Pj.)', 'period' => '2003-2007', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Zaenal Mustofa, S.Pd.I', 'period' => '2007-2019', 'photo' => 'assets/img/officer/placeholder.jpg'],
                            ['name' => 'Bambang Siswaya, S.T.', 'period' => '2019-sekarang', 'photo' => 'assets/img/officer/pakBam.jpg']
                        ];
                    @endphp
                    <div class="relative overflow-hidden" id="authority-slider-wrapper">
                        <div class="flex transition-transform duration-500 ease-in-out" id="authoritySlider">
                            @foreach($leaders as $leader)
                                <div class="min-w-full flex-shrink-0 px-4">
                                    <div class="text-center">
                                        <img src="{{ asset($leader['photo']) }}" alt="{{ $leader['name'] }}"
                                            class="w-48 h-48 mx-auto mb-4 rounded-full object-cover shadow-lg border-4 border-white dark:border-gray-700">
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                                            {{ $leader['name'] }}
                                        </h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Periode: {{ $leader['period'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-center mt-6 space-x-2" id="authority-dots">
                            @foreach($leaders as $index => $leader)
                                <button
                                    class="authority-dot w-3 h-3 rounded-full transition-colors duration-300 {{ $loop->first ? 'bg-primary-600' : 'bg-gray-300' }}"
                                    data-slide-to="{{ $index }}"></button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Visi dan Misi --}}
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-gray-900 p-8 rounded-xl shadow-lg animate-fade-in-up">
                        <h3 class="text-xl font-semibold text-primary-600 dark:text-primary-400 mb-6 flex items-center">
                            <i class="fas fa-eye mr-3"></i> Visi
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed italic">"Mewujudkan Desa Slorok sebagai
                            desa yang maju, mandiri, dan sejahtera berdasarkan nilai-nilai gotong royong dan kearifan lokal
                            pada tahun 2030"</p>
                    </div>
                    <div class="bg-white dark:bg-gray-900 p-8 rounded-xl shadow-lg animate-fade-in-up">
                        <h3 class="text-xl font-semibold text-primary-600 dark:text-primary-400 mb-6 flex items-center">
                            <i class="fas fa-bullseye mr-3"></i> Misi
                        </h3>
                        <ul class="space-y-3 text-gray-700 dark:text-gray-300">
                            <li class="flex items-start"><i
                                    class="fas fa-check text-primary-600 mr-3 mt-1 flex-shrink-0"></i><span>Meningkatkan
                                    kualitas sumber daya manusia melalui pendidikan dan pelatihan keterampilan.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-check text-primary-600 mr-3 mt-1 flex-shrink-0"></i><span>Mengembangkan
                                    potensi ekonomi desa berbasis pertanian dan UMKM.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-check text-primary-600 mr-3 mt-1 flex-shrink-0"></i><span>Membangun
                                    infrastruktur desa yang mendukung aktivitas ekonomi dan sosial masyarakat.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-check text-primary-600 mr-3 mt-1 flex-shrink-0"></i><span>Melestarikan
                                    lingkungan hidup dan kearifan lokal.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-check text-primary-600 mr-3 mt-1 flex-shrink-0"></i><span>Meningkatkan
                                    kualitas pelayanan publik yang transparan dan akuntabel.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-check text-primary-600 mr-3 mt-1 flex-shrink-0"></i><span>Memperkuat
                                    nilai-nilai gotong royong dan kebersamaan dalam kehidupan bermasyarakat.</span></li>
                        </ul>
                    </div>
                </div>


                {{-- Slider Galeri Desa --}}
                <div class="bg-white dark:bg-gray-900 p-8 rounded-xl shadow-lg animate-fade-in-up">
                    <h3 class="text-xl font-semibold text-primary-600 dark:text-primary-400 mb-6 flex items-center">
                        <i class="fas fa-images mr-3"></i> Galeri Desa
                    </h3>
                    <div class="relative w-full h-64 md:h-96 overflow-hidden rounded-xl" id="gallery-slider-wrapper">
                        <div class="flex transition-transform duration-700 ease-in-out h-full" id="gallerySlider">
                            @php
                                $galleryImages = [
                                    "https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1932&auto=format&fit=crop",
                                    "https://images.unsplash.com/photo-1505080857763-eecb2da806a0?q=80&w=1740&auto=format&fit=crop",
                                    "https://images.unsplash.com/photo-1471879832106-c7ab9e013d84?q=80&w=1674&auto=format&fit=crop",
                                    "https://images.unsplash.com/photo-1586511925558-a4c6376fe658?q=80&w=1887&auto=format&fit=crop",
                                ];
                            @endphp
                            @foreach($galleryImages as $src)
                                <div class="w-full flex-shrink-0 h-full">
                                    <img src="{{ $src }}" class="w-full h-full object-cover" alt="Galeri Desa">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Peta Wilayah --}}
                <div class="bg-white dark:bg-gray-900 p-8 rounded-xl shadow-lg animate-fade-in-up">
                    <h3
                        class="text-xl font-semibold text-primary-600 dark:text-primary-400 mb-6 flex items-center justify-center">
                        <i class="fas fa-map mr-3"></i> Peta Wilayah Desa
                    </h3>
                    <div class="aspect-w-16 aspect-h-9 h-96">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15801.335345750272!2d112.28590669298414!3d-8.06734288019313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e789526c4983"
                            class="w-full h-full rounded-lg border-0" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                {{-- Struktur Pemerintahan Desa (Modal Gambar) --}}
                <div class="bg-white dark:bg-gray-900 p-8 rounded-xl shadow-lg animate-fade-in-up">
                    <h3
                        class="text-xl font-semibold text-primary-600 dark:text-primary-400 mb-6 flex items-center justify-center">
                        <i class="fas fa-sitemap mr-3"></i>
                        Struktur Pemerintahan Desa
                    </h3>
                    <div class="text-center">
                        <img src="{{ asset('assets/img/struktur-desa.jpg') }}" alt="Struktur Pemerintahan Desa"
                            class="max-w-full h-auto rounded-lg shadow-md cursor-pointer"
                            onclick="openModal('strukturModal')">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Klik gambar untuk memperbesar</p>
                    </div>
                </div>

                {{-- Modal Struktur Desa --}}
                <div id="strukturModal"
                    class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden justify-center items-center">
                    <span class="absolute top-6 right-8 text-white text-3xl font-bold cursor-pointer"
                        onclick="closeModal('strukturModal')">&times;</span>
                    <img class="max-w-screen-lg max-h-screen object-contain"
                        src="{{ asset('assets/img/struktur-desa.jpg') }}" alt="Struktur Pemerintahan Desa - Detail">
                </div>

            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/profile.js') }}"></script>
@endpush