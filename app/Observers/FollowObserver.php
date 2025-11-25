<?php

namespace App\Observers;

use App\Models\Follow;

//
// Tugas:
// - Auto-update followers_count dan following_count di tabel users
// - Kirim notifikasi saat ada follow baru
//
// Methods:
// - created(Follow \$follow) Increment counts & buat notifikasi
// - deleted(Follow \$follow) Decrement counts
//
class FollowObserver
{
    //
}
