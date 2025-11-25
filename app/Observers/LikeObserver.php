<?php

namespace App\Observers;

use App\Models\Like;
use App\Services\NotificationService;

//
// Tugas:
// - Auto-update likes_count di tabel posts
// - Kirim notifikasi saat ada like baru
//
// Methods:
// - created(Like \$like) Increment likes_count & buat notifikasi
// - deleted(Like \$like) Decrement likes_count
//
class LikeObserver
{
    public function __construct(protected NotificationService $notificationService) {}

    /**
     * Handle the Like "created" event.
     */
    public function created(Like $like): void
    {
        // Increment likes_count pada post
        $like->post()->increment('likes_count');

        // Kirim notifikasi via service
        $this->notificationService->notifyLike($like->user_id, $like->post_id);
    }

    /**
     * Handle the Like "deleted" event.
     */
    public function deleted(Like $like): void
    {
        // Decrement likes_count pada post
        $like->post()->decrement('likes_count');

        // Hapus notifikasi via service
        $this->notificationService->deleteNotification(
            'like',
            $like->user_id,
            $like->post->user_id,
            $like->post_id
        );
    }
}
