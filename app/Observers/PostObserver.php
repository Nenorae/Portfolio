<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

//
// Tugas:
// - Auto-update posts_count di tabel users saat post dibuat/dihapus
// - Hapus file gambar saat post dihapus
//
// Methods:
// - created(Post \$post) Increment posts_count
// - deleted(Post \$post) Decrement posts_count & hapus file
//
class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        // Increment posts_count pada user
        $post->user()->increment('posts_count');
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        // Decrement posts_count pada user
        $post->user()->decrement('posts_count');

        // Hapus file gambar jika ada
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
    }
}
