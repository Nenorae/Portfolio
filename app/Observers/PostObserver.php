<?php

namespace App\Observers;

use App\Models\Post;

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
    //
}
