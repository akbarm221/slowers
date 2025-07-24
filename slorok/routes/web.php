<?php

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
Route::middleware([FirebaseAuth::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        $user = session('firebase_user');
        return view('admin.dashboard', compact('user'));
    });
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
