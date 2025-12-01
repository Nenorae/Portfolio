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
        // Simpan hasil sync ke variabel
        $result = Auth::user()->following()->syncWithoutDetaching([$user->id]);

        // Cek array 'attached'. 
        // Jika ada isinya, berarti ini adalah FOLLOW BARU.
        // Jika kosong, berarti user sudah follow sebelumnya (cuma iseng klik lagi).
        if (!empty($result['attached'])) {
            // HANYA kirim notifikasi jika ini follow baru
            $user->notify(new NewFollower(Auth::user()));
        }

        // Respon JSON untuk AJAX
        if (request()->wantsJson()) {
            return response()->json([
                'following' => true,
                // Update jumlah follower real-time
                'followers_count' => $user->followers()->count() 
            ]);
        }

        return back();
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
