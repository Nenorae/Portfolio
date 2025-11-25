<?php

namespace App\Observers;

use App\Models\Like;

//
// Tugas:
// - Auto-update likes_count di tabel posts
// - Kirim notifikasi saat ada like baru
//
// Methods:
// - created(Like \$like) Increment likes_count & buat notifikasi
// - deleted(Like \$like) Decrement likes_count
//
class LikeObserver
{
    //
}
