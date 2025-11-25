<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    protected $fillable = [
        'follower_id',
        'following_id',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function ($follow) {
            if ($follow->follower_id === $follow->following_id) {
                return false; // Mencegah user follow diri sendiri
            }
        });
    }

    /**
     * User yang melakukan follow.
     */
    public function follower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    /**
     * User yang di-follow.
     */
    public function following(): BelongsTo
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
