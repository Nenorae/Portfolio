<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// use App\Http\Requests\UpdateProfileRequest; // Uncomment jika sudah buat requestnya

class ProfileController extends Controller
{
    // show(\$username) GET: Tampilkan profil user
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        // Load posts milik user tersebut
        $posts = $user->posts()->latest()->get();
        
        return view('profile.show', compact('user', 'posts'));
    }

    // edit() GET: Form edit profil sendiri
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // update(UpdateProfileRequest $request) PUT: Update profil
    // Menggunakan Request biasa dulu agar compilable jika UpdateProfileRequest belum dibuat
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'location' => 'nullable|string',
            'website' => 'nullable|url',
        ]);

        $user->update($validated);

        return redirect()->route('profile.show', $user->username)->with('success', 'Profile updated!');
    }

    // uploadProfilePhoto(Request $request) POST: Upload foto profil
    public function uploadProfilePhoto(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048', // Max 2MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika bukan default
            if ($user->avatar && $user->avatar !== 'default.jpg') {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => $path]);
        }

        return back()->with('success', 'Photo updated!');
    }

    // followers(\$username) GET: List followers
    public function followers($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $followers = $user->followers;
        return view('profile.followers', compact('user', 'followers'));
    }

    // following(\$username) GET: List following
    public function following($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $following = $user->following;
        return view('profile.following', compact('user', 'following'));
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
