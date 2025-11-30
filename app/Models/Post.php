<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk akses Auth

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
// - isLikedBy($userId) Cek apakah post di-like user tertentu
// - hasLiked() Cek apakah post di-like user yang sedang LOGIN (Fix Error)
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
     * FIX ERROR: Method ini yang dipanggil di dashboard.blade.php
     * Cek apakah user yang sedang login sudah like post ini.
     */
    public function hasLiked(): bool
    {
        // Jika user tidak login, return false
        if (!Auth::check()) {
            return false;
        }

        // Cek menggunakan relasi likes
        return $this->likes()->where('user_id', Auth::id())->exists();
    }

    /**
     * Cek apakah post di-like oleh user tertentu (spesifik ID).
     */
    public function isLikedBy(int $userId): bool
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Scope untuk mengurutkan post berdasarkan yang terbaru.
     */
    public function scopeLatest(Builder $query): Builder // Note: Signature harus kompatibel dengan parent jika ada conflict
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope untuk mendapatkan post dari user yang di-follow.
     */
    public function scopeFromFollowing(Builder $query, int $userId): Builder
    {
        // Ambil ID user yang difollow oleh $userId
        // Catatan: Pastikan User model memiliki relasi 'following'
        $followingIds = User::find($userId)?->following()->pluck('following_id');

        // Kembalikan query post dimana user_id ada dalam daftar following
        return $query->whereIn('user_id', $followingIds ?? []);
    }
}
