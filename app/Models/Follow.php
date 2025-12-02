<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follow extends Model
{
    protected $fillable = [
        'follower_id',
        'following_id',
    ];

    protected static function booted(): void
    {
        static::creating(function ($follow) {
            // Prevent a user from following themselves
            if ($follow->follower_id === $follow->following_id) {
                return false;
            }
        });
    }

    /**
     * Get the user that is following.
     */
    public function follower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    /**
     * Get the user that is being followed.
     */
    public function following(): BelongsTo
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
