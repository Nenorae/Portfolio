<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//
// Tugas:
// - Representasi tabel likes
// - Mengelola relasi like antara user dan post
//
// Relasi:
// - user() belongsTo User
// - post() belongsTo Post
//
class Like extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    /**
     * User yang memberikan like.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Post yang di-like.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
