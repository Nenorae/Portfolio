<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        // Increment posts_count for the user
        $post->user()->increment('posts_count');
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        // Decrement posts_count for the user
        $post->user()->decrement('posts_count');

        // Delete the image file if it exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
    }
}
