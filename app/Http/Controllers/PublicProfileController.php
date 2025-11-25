<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show($username)
    {
        // Logic sesuai persis dengan gambar yang kamu kirim
        $user = User::with(['skills', 'portfolios'])
                    ->where('username', $username)
                    ->firstOrFail();

        return view('public.profile', [
            'user' => $user
        ]);
    }
}