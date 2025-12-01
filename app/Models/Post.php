<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'caption',
        'image',
        'github_link',
        'demo_link',
        // HAPUS 'likes_count' dari fillable - sebaiknya dihitung via relasi
    ];

    // protected $with = ['user']; // Opsional: auto eager load user

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
     * FIX: Method untuk cek apakah user sedang login sudah like post ini.
     * Lebih aman dengan dependency injection.
     */
    
    // Helper: Cek apakah user yang sedang login sudah like post ini?
    public function hasLiked($user)
    {
        if (!$user) return false;
        return $this->likes->where('user_id', $user->id)->count() > 0;
    }

    /**
     * Cek apakah post di-like oleh user tertentu (spesifik ID).
     */
    public function isLikedBy(int $userId): bool
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Accessor untuk likes count yang selalu fresh dari database.
     */
    public function getLikesCountAttribute(): int
    {
        // Jika sudah di-load dengan withCount, gunakan value tersebut
        if (array_key_exists('likes_count', $this->attributes)) {
            return $this->attributes['likes_count'];
        }

        return $this->likes()->count();
    }

    /**
     * Scope untuk mengurutkan post berdasarkan yang terbaru.
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope untuk mendapatkan post dari user yang di-follow.
     * IMPROVEMENT: Gunakan relationship yang sudah ada
     */
    public function scopeFromFollowing(Builder $query, int $userId): Builder
    {
        $user = User::find($userId);
        
        if (!$user) {
            return $query->whereNull('user_id'); // Return empty result jika user tidak ditemukan
        }

        // Ambil ID user yang difollow
        $followingIds = $user->following()->pluck('users.id');

        return $query->whereIn('user_id', $followingIds);
    }

    /**
     * Scope untuk posts dengan user relationship (eager load)
     */
    public function scopeWithUser(Builder $query): Builder
    {
        return $query->with('user');
    }

    /**
     * Scope untuk posts dengan likes count
     */
    public function scopeWithLikesCount(Builder $query): Builder
    {
        return $query->withCount('likes');
    }

    /**
     * Accessor untuk memastikan image URL selalu proper
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        // Fallback image jika tidak ada
        return asset('images/default-post.jpg');
    }

    /**
     * Boot method untuk model events
     */
    protected static function boot()
    {
        parent::boot();

        // Auto delete related likes ketika post dihapus
        static::deleting(function ($post) {
            $post->likes()->delete();
        });
    }
}