<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//
// Tugas:
// - Mengelola notifikasi follow & like
// - Scope unread
//
// Relasi:
// - user() belongsTo User (penerima)
// - actor() belongsTo User (pelaku aksi)
// - post() belongsTo Post (untuk notifikasi like)
//
// Methods:
// - markAsRead() Tandai sudah dibaca
// - scopeUnread($query) Filter notifikasi belum dibaca
//
class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'actor_id',
        'type',
        'post_id',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * User penerima notifikasi.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * User yang melakukan aksi (sumber notifikasi).
     */
    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    /**
     * Post terkait notifikasi (jika ada).
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Tandai notifikasi sebagai sudah dibaca.
     */
    public function markAsRead(): bool
    {
        return $this->update(['is_read' => true]);
    }

    /**
     * Scope untuk memfilter notifikasi yang belum dibaca.
     */
    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('is_read', false);
    }
}
