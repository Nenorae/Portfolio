<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewFollower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Follow a user.
     */
    public function store(User $user)
    {
        $result = Auth::user()->following()->syncWithoutDetaching([$user->id]);

        // If the user was not already following, send a notification
        if (!empty($result['attached'])) {
            $user->notify(new NewFollower(Auth::user()));
        }

        if (request()->wantsJson()) {
            return response()->json([
                'following' => true,
                'followers_count' => $user->followers()->count() 
            ]);
        }

        return back();
    }

    /**
     * Unfollow a user.
     */
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
