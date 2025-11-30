<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'nim',

        // Tambahan untuk profil publik
        'username',
        'bio',
        'major',
        'generation',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi Keahlian
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    // Relasi Portofolio
    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    /**
     * Posts yang dimiliki user.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Likes yang diberikan user.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Notifikasi yang diterima user.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    /**
     * User yang mengikuti user ini.
     */
    public function followers(): HasMany
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    /**
     * User yang diikuti oleh user ini.
     */
    public function following(): HasMany
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    /**
     * Cek apakah user ini mengikuti user lain.
     */
    public function isFollowing(User $user): bool
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    /**
     * Cek apakah user ini diikuti oleh user lain.
     */
    public function isFollowedBy(User $user): bool
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }

    /**
     * User ini mengikuti user lain.
     */
    public function follow(User $user): void
    {
        $this->following()->firstOrCreate(['following_id' => $user->id]);
    }

    /**
     * User ini berhenti mengikuti user lain.
     */
    public function unfollow(User $user): void
    {
        $this->following()->where('following_id', $user->id)->delete();
    }

    /**
     * Cek apakah user ini sudah me-like sebuah post.
     */
    public function hasLiked(Post $post): bool
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }
}
