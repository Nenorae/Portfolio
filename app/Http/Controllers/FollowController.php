<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewFollower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // store(User $user) POST: Follow user
    public function store(User $user)
    {
        if (Auth::id() === $user->id) {
            if (request()->wantsJson()) {
                return response()->json(['error' => 'You cannot follow yourself.'], 422);
            }
            return back()->with('error', 'You cannot follow yourself.');
        }

        // Attach relationship (Follow)
        Auth::user()->following()->syncWithoutDetaching([$user->id]);

        // Kirim notifikasi saat follow
        $user->notify(new NewFollower(Auth::user()));
        // (Pastikan Class Notification dibuat agar baris di atas bisa jalan)
        if (request()->wantsJson()) {
            return response()->json([
                'following' => true,
            ]);
        }

        return back()->with('success', 'You are now following ' . $user->name);
    }

    // destroy(User $user) DELETE: Unfollow user
    public function destroy(User $user)
    {
        Auth::user()->following()->detach($user->id);

        if (request()->wantsJson()) {
            return response()->json([
                'following' => false,
            ]);
        }
        return back()->with('success', 'Unfollowed ' . $user->name);
    }
}


//
// Tugas:
// - Follow user lain
// - Unfollow user
// - Kirim notifikasi saat follow
//
// Methods:
// - store(User \$user) POST: Follow user
// - destroy(User \$user) DELETE: Unfollow user
//
