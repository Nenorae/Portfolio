<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest; // Pastikan ini ada (bawaan Breeze)
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // ==========================================
    // BAGIAN 1: FITUR SOSIAL (Show, Follow)
    // ==========================================

    /**
     * Menampilkan profil publik user lain (kampus.id/username)
     */
    public function show($username)
    {
        // Cari user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();
        
        // Load posts milik user tersebut (diurutkan terbaru)
        // Asumsi relasi posts() sudah ada di Model User
        $posts = $user->posts()->with('user')->latest()->get();
        
        // Hitung stats (opsional, bisa di-handle di view via relationship count)
        $postsCount = $posts->count();
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();

        return view('profile.show', compact('user', 'posts', 'postsCount', 'followersCount', 'followingCount'));
    }

    /**
     * Menampilkan daftar followers
     */
    public function followers($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $followers = $user->followers;
        return view('profile.followers', compact('user', 'followers'));
    }

    /**
     * Menampilkan daftar following
     */
    public function following($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $following = $user->following;
        return view('profile.following', compact('user', 'following'));
    }

    // ==========================================
    // BAGIAN 2: MANAJEMEN AKUN (Edit, Update, Destroy)
    // ==========================================

    /**
     * Menampilkan form edit profil
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * OTAK UTAMA: Update profil (Info, Bio, Website, & Foto sekaligus)
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // 1. Validasi Input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:500'],
            'website' => ['nullable', 'url', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        // 2. Isi data teks dasar
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // 3. Isi data tambahan (Bio & Website)
        // Kita cek apakah key-nya ada di request, untuk keamanan
        $user->bio = $request->bio;
        $user->website = $request->website;

        // 4. Cek apakah email berubah (Reset verifikasi jika ya)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 5. LOGIKA UPLOAD FOTO (Digabung di sini agar efisien)
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada dan bukan default
            if ($user->profile_photo && $user->profile_photo !== 'default.jpg') {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Simpan foto baru
            $path = $request->file('avatar')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // 6. Simpan Perubahan
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Hapus akun user
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Hapus foto profil dari storage jika ada sebelum hapus user
        if ($user->profile_photo && $user->profile_photo !== 'default.jpg') {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

//
// Tugas:
// - Menampilkan profil user (diri sendiri atau orang lain)
// - Edit profil (bio, foto, lokasi, website)
// - Upload foto profil
// - Menampilkan posts user
// - Menampilkan followers & following list
//
// Methods:
// - show(\$username) GET: Tampilkan profil user
// - edit() GET: Form edit profil sendiri
// - update(UpdateProfileRequest \$request) PUT: Update profil
// - uploadProfilePhoto(Request \$request) POST: Upload foto profil
// - followers(\$username) GET: List followers
// - following(\$username) GET: List following
//
