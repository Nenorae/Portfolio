<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//
// Tugas:
// - Representasi tabel follows
// - Mengelola relasi follow antara dua user
// - Validasi untuk mencegah follow diri sendiri
//
// Relasi:
// - follower() belongsTo User (yang follow)
// - following() belongsTo User (yang di-follow)
//
class Follow extends Model
{
    //
}
