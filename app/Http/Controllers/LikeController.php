<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Notifications\PostLiked; // Uncomment nanti

class LikeController extends Controller
{
    // store(Post $post) POST: Like post
    public function store(Post $post)
    {
        // Cek apakah sudah like sebelumnya untuk mencegah duplikat
        if (!$post->likes()->where('user_id', Auth::id())->exists()) {
            $post->likes()->create([
                'user_id' => Auth::id()
            ]);

            // Kirim notifikasi saat like (kecuali like post sendiri)
            if ($post->user_id !== Auth::id()) {
                // $post->user->notify(new PostLiked(Auth::user(), $post));
            }
        }

        return back();
    }

    // destroy(Post $post) DELETE: Unlike post
    public function destroy(Post $post)
    {
        $post->likes()->where('user_id', Auth::id())->delete();

        return back();
    }
}


//
// Tugas:
// - Like postingan
// - Unlike postingan
// - Kirim notifikasi saat like
//
// Methods:
// - store(Post \$post) POST: Like post
// - destroy(Post \$post) DELETE: Unlike post
//
