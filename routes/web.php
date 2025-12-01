<?php

use Illuminate\Support\Facades\Route;
// Import Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FollowController; // Pakai ini untuk Follow
use App\Http\Controllers\LikeController;   // Pakai ini untuk Like
use App\Http\Controllers\SkillController; // <--- TAMBAHIN INI

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

// --- 1. PUBLIC ROUTES (Bisa diakses tanpa login) ---
Route::get('/', function () {
    return view('landing');
});

// Gallery / Explore (Daftar Postingan)
Route::get('/karya', [PostController::class, 'index'])->name('posts.index');

// Public Profile (Akses via url/u/username untuk tamu)
Route::get('/u/{username}', [PublicProfileController::class, 'show'])->name('public.profile');


// --- 2. AUTHENTICATED ROUTES (Harus Login) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Settings (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- FITUR UTAMA ---

    // Posts (CRUD) - Index dipisah di atas (/karya)
    Route::resource('posts', PostController::class)->except(['index']);

    // Likes (Menggunakan LikeController yang sudah difix)
    Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
    Route::delete('/posts/{post}/unlike', [LikeController::class, 'destroy'])->name('posts.unlike');

    // Follow System (Menggunakan FollowController)
    Route::post('/users/{user}/follow', [FollowController::class, 'store'])->name('users.follow');
    Route::delete('/users/{user}/unfollow', [FollowController::class, 'destroy'])->name('users.unfollow');

    // Notifications
    Route::get('/notifications/json', [NotificationController::class, 'getJsonNotifications'])->name('notifications.json');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Search
    Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.users');

    // Skills (Placeholder)
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');
});


// --- 3. CATCH-ALL ROUTE (WAJIB PALING BAWAH) ---
// Route ini menangkap "username" di URL. Kalau ditaruh di atas,
// halaman "dashboard" atau "posts" akan dianggap sebagai username.
Route::middleware('auth')->get('/{username}', [PublicProfileController::class, 'show'])->name('profile.show');
