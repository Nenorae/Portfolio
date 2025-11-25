<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan (Landing Page) - Dari kode atas
Route::get('/', function () {
    return view('landing');
});

// Dashboard - Menggunakan prioritas kode atas (dengan middleware verified)
Route::get('/dashboard', function () {
    // Catatan: Pastikan nama file view-nya 'dashboard' atau 'dashboard.index' sesuai folder kamu
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup Auth (Hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    // Profile Routes (Bawaan Kode Atas - Lebih lengkap karena ada update/destroy)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Tambahan dari Kode Bawah (Portfolio & Skills) ---

    // Portfolio CRUD
    Route::view('/portfolio', 'portfolio.index')->name('portfolio.index');
    Route::view('/portfolio/create', 'portfolio.create')->name('portfolio.create');
    Route::view('/portfolio/{id}/edit', 'portfolio.edit')->name('portfolio.edit');

    // Skills CRUD
    Route::view('/skills', 'skills.index')->name('skills.index');
    Route::view('/skills/create', 'skills.create')->name('skills.create');
    Route::view('/skills/{id}/edit', 'skills.edit')->name('skills.edit');
});

// Public Profile Dynamic Route (Bisa diakses tanpa login)
Route::get('/u/{username}', [PublicProfileController::class, 'show'])->name('public.profile');

// Mengambil route auth bawaan (Login, Register, Logout)
// Ini menggantikan route manual login/logout/register yang ada di kode bawah
require __DIR__ . '/auth.php';
