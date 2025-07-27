<?php

use App\Http\Controllers\Admin\BeritaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController; // Tambahkan ini
use App\Http\Controllers\Auth\FirebaseAuthController; // <--- PASTIKAN BARIS INI BENAR
use App\Http\Middleware\FirebaseAuth;

// Rute untuk halaman Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk halaman lainnya
Route::get('/profil', [PageController::class, 'profile'])->name('profile');
Route::get('/infografis', [PageController::class, 'infografis'])->name('infografis');
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
Route::get('/bumdes', [PageController::class, 'bumdes'])->name('bumdes');

// Rute untuk halaman tersembunyi (dari link di footer)
Route::get('/team-profile', [PageController::class, 'hiddenPage'])->name('hidden.page');

/* |--------------------------------------------------------------------------
| Rute untuk Data Grafik (API)
|--------------------------------------------------------------------------
*/
Route::get('/data/infografis/pendidikan', [InfographicController::class, 'getEducationData'])->name('data.infographics.education');
Route::get('/data/infografis/pendidikan', [InfographicController::class, 'getEducationData']);

// Rute Autentikasi
Route::get('/login', [FirebaseAuthController::class, 'showLogin'])->name('login');
Route::post('/firebase/verify-token', [FirebaseAuthController::class, 'verifyToken']);
Route::get('/logout', [FirebaseAuthController::class, 'logout'])->name('logout');

// Rute Dashboard yang Dilindungi
Route::middleware(['auth.firebase'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});


/* |--------------------------------------------------------------------------
| Rute Admin yang Dilindungi
|--------------------------------------------------------------------------
*/
Route::middleware([FirebaseAuth::class])->prefix('admin')->name('admin.')->group(function () {

    // URL: /admin/dashboard
    // Nama: admin.dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // URL: /admin/infografis
    // Nama: admin.infografis.index
    Route::get('/infografis', function () {
        return view('admin.infografis.index');
    })->name('infografis.index');

    // Rute untuk menampilkan form edit jumlah penduduk
    Route::get('/infografis/penduduk/edit', function () {
        // Mengarahkan ke file baru yang lebih spesifik
        return view('admin.infografis.penduduk.edit_jumlah_penduduk');
    })->name('infografis.penduduk.edit');

    // Rute BARU untuk menampilkan form edit data pekerjaan
    Route::get('/infografis/pekerjaan/edit', function () {
        return view('admin.infografis.pekerjaan.edit_pekerjaan');
    })->name('infografis.pekerjaan.edit');

    Route::get('/infografis/agama/edit', function () {
        return view('admin.infografis.agama.edit_agama');
    })->name('infografis.agama.edit');

    Route::get('/infografis/pendidikan/edit', function () {
        return view('admin.infografis.pendidikan.edit_pendidikan');
    })->name('infografis.pendidikan.edit');
// --- TAMBAHKAN RUTE DI BAWAH INI ---
    Route::get('/infografis/apbd/create', function() {
        return view('admin.infografis.apbd.create_apbd');
    })->name('infografis.apbd.create');
    
    // Rute untuk menampilkan form UPDATE data APBD
    Route::get('/infografis/apbd/{tahun}/edit', function($tahun) {
        // Arahkan ke view form 'edit' Anda, kirim data tahun
        // return view('admin.infografis.apbd.edit_apbd', ['tahun' => $tahun]);
    })->name('infografis.apbd.edit');

     Route::resource('berita', BeritaController::class);
});


Route::get('/firebase/config', function () {
    return response()->json([
        'apiKey' => env('FIREBASE_API_KEY'),
        'authDomain' => env('FIREBASE_AUTH_DOMAIN'),
        'projectId' => env('FIREBASE_PROJECT_ID'),
        'storageBucket' => env('FIREBASE_STORAGE_BUCKET'),
        'messagingSenderId' => env('FIREBASE_MESSAGING_SENDER_ID'),
        'appId' => env('FIREBASE_APP_ID'),
    ]);
});


    Route::get('/supabase/config', function () {
        return response()->json([
            'url' => env('SUPABASE_URL'),
            'key' => env('SUPABASE_KEY'),
        ]);
    });

    