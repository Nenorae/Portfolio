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
    ];

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the likes for the post.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
    
    /**
     * Check if the currently authenticated user has liked this post.
     */
    public function hasLiked($user)
    {
        if (!$user) return false;
        return $this->likes->where('user_id', $user->id)->count() > 0;
    }

    /**
     * Check if the post is liked by a specific user.
     */
    public function isLikedBy(int $userId): bool
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Get the number of likes for the post.
     */
    public function getLikesCountAttribute(): int
    {
        if (array_key_exists('likes_count', $this->attributes)) {
            return $this->attributes['likes_count'];
        }

        return $this->likes()->count();
    }

    /**
     * Scope a query to order posts by the latest creation date.
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to retrieve posts from users the given user is following.
     */
    public function scopeFromFollowing(Builder $query, int $userId): Builder
    {
        $user = User::find($userId);
        
        if (!$user) {
            return $query->whereNull('user_id');
        }

        $followingIds = $user->following()->pluck('users.id');

        return $query->whereIn('user_id', $followingIds);
    }

    /**
     * Scope a query to eager load the user relationship.
     */
    public function scopeWithUser(Builder $query): Builder
    {
        return $query->with('user');
    }

    /**
     * Scope a query to eager load the likes count.
     */
    public function scopeWithLikesCount(Builder $query): Builder
    {
        return $query->withCount('likes');
    }

    /**
     * Get the image URL for the post.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return asset('images/default-post.jpg');
    }

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete related likes when a post is deleted
        static::deleting(function ($post) {
            $post->likes()->delete();
        });
    }
}