<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PublicProfileController;

// Auth Pages
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// Dashboard
Route::view('/dashboard', 'dashboard.index')->name('dashboard');

// Profile
Route::view('/profile', 'profile.edit')->name('profile.edit');

// Portfolio CRUD
Route::view('/portfolio', 'portfolio.index')->name('portfolio.index');
Route::view('/portfolio/create', 'portfolio.create')->name('portfolio.create');
Route::view('/portfolio/{id}/edit', 'portfolio.edit')->name('portfolio.edit');

// Skills CRUD
Route::view('/skills', 'skills.index')->name('skills.index');
Route::view('/skills/create', 'skills.create')->name('skills.create');
Route::view('/skills/{id}/edit', 'skills.edit')->name('skills.edit');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Public Profile Dynamic Route
Route::get('/u/{username}', [PublicProfileController::class, 'show'])->name('public.profile');
