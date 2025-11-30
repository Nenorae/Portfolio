<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

// Halaman Depan
Route::get('/', function () {
    return view('landing');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Fitur Autentikasi
Route::middleware('auth')->group(function () {

    // Profil (Edit)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'uploadProfilePhoto'])->name('profile.photo.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Postingan (Upload Karya)
    // Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); // New route for single post

    // API Search & Notifikasi
    Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.users');
    Route::get('/notifications/json', [NotificationController::class, 'getJsonNotifications'])->name('notifications.json');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Like/Unlike posts
    Route::post('/posts/{post}/like', [\App\Http\Controllers\LikeController::class, 'store'])->name('posts.like');
    Route::delete('/posts/{post}/like', [\App\Http\Controllers\LikeController::class, 'destroy'])->name('posts.unlike');

    // Follow/Unfollow users
    Route::post('/users/{user}/follow', [\App\Http\Controllers\FollowController::class, 'store'])->name('users.follow');
    Route::delete('/users/{user}/follow', [\App\Http\Controllers\FollowController::class, 'destroy'])->name('users.unfollow');

    // Profil Internal (Wajib paling bawah)
    Route::get('/{username}', [PublicProfileController::class, 'show'])->name('profile.show');
});

// Profil Publik
Route::get('/u/{username}', [PublicProfileController::class, 'show'])->name('public.profile');
