<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Import Model Post
use App\Models\User; // Import Model User
use Illuminate\Support\Facades\Auth; // Import Auth untuk cek user login

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil semua Postingan (Urutkan dari yang terbaru)
        // 'with("user")' berguna agar query ringan (Eager Loading)
        $posts = Post::with('user')->latest()->get();

        // 2. Ambil Rekomendasi Teman (User lain selain kita)
        // Ambil 5 user secara acak
        $suggestedUsers = User::where('id', '!=', Auth::id())
            ->inRandomOrder()
            ->limit(5)
            ->get();

        // 3. Kirim kedua data tersebut ke View 'dashboard'
        return view('dashboard', [
            'posts' => $posts,
            'suggestedUsers' => $suggestedUsers
        ]);
    }
}
