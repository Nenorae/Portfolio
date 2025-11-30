<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show($username)
    {
        // Gunakan withCount untuk efisiensi query
        $user = User::where('username', $username)
            ->withCount(['posts', 'followers', 'following'])
            ->firstOrFail();

        // Ambil data postingan terpisah
        $posts = $user->posts()->latest()->get();

        return view('profile.show', [
            'user'           => $user,
            'posts'          => $posts,
            'postsCount'     => $user->posts_count,
            'followersCount' => $user->followers_count,
            'followingCount' => $user->following_count,
        ]);
    }
}