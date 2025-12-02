<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the latest posts from all users
        $posts = Post::with('user')->latest()->paginate(5);

        // Get suggested users to follow
        $suggestedUsers = User::where('id', '!=', Auth::id())
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('dashboard', [
            'posts' => $posts,
            'suggestedUsers' => $suggestedUsers
        ]);
    }
}
