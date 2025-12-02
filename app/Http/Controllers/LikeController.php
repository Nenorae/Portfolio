<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Like a post.
     */
    public function store(Post $post)
    {
        // Prevent duplicate likes
        if (!$post->likes()->where('user_id', Auth::id())->exists()) {
            $post->likes()->create([
                'user_id' => Auth::id()
            ]);

            // Don't send a notification if the user likes their own post
            if ($post->user_id !== Auth::id()) {
                // $post->user->notify(new PostLiked(Auth::user(), $post));
            }
        }

        if (request()->wantsJson()) {
            return response()->json([
                'liked' => true,
                'likes_count' => $post->likes()->count(),
            ]);
        }

        return back();
    }

    /**
     * Unlike a post.
     */
    public function destroy(Post $post)
    {
        $post->likes()->where('user_id', Auth::id())->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'liked' => false,
                'likes_count' => $post->likes()->count(),
            ]);
        }

        return back();
    }
}
