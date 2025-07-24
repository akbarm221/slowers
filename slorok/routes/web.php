<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController; // Tambahkan ini
use App\Http\Controllers\Auth\FirebaseAuthController; // <--- PASTIKAN BARIS INI BENAR

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
// Rute untuk halaman admin yang dilindungi
Route::middleware(['firebase.auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Tambahkan rute admin lainnya di sini
});