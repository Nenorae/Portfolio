<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//
// Tugas:
// - Representasi tabel posts
// - Mengelola relasi dengan User dan Like
// - Menangani upload gambar
// - Menyediakan scope seperti latest & fromFollowing
//
// Relasi:
// - user() belongsTo User
// - likes() hasMany Like
//
// Methods:
// - isLikedBy($userId) Cek apakah post di-like user
// - scopeLatest($query) Sorting berdasarkan terbaru
// - scopeFromFollowing($query, $userId) Feed berdasarkan user yang di-follow
//
class Post extends Model
{
    //
}
