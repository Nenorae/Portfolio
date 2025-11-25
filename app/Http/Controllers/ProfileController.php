<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
class ProfileController extends Controller
{
    //
}
