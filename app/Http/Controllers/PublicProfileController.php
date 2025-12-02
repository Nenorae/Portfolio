<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    /**
     * Display the specified user's profile.
     */
    public function show($username)
    {
        // Use withCount for efficiency
        $user = User::where('username', $username)
            ->withCount(['posts', 'followers', 'following'])
            ->firstOrFail();

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