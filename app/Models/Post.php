<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    protected $fillable = [
        'user_id',
        'title',
        'caption',
        'image',
        'github_link',
        'demo_link',
        'likes_count',
    ];

    /**
     * User pemilik post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Likes untuk post ini.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Cek apakah post di-like oleh user tertentu.
     */
    public function isLikedBy(int $userId): bool
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Scope untuk mengurutkan post berdasarkan yang terbaru.
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->latest();
    }

    /**
     * Scope untuk mendapatkan post dari user yang di-follow.
     */
    public function scopeFromFollowing(Builder $query, int $userId): Builder
    {
        $followingIds = User::find($userId)?->following()->pluck('following_id');

        return $query->whereIn('user_id', $followingIds ?? []);
    }
}
