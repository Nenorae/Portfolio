<?php

namespace App\Observers;

use App\Models\Follow;
use App\Services\NotificationService;

//
// Tugas:
// - Auto-update followers_count dan following_count di tabel users
// - Kirim notifikasi saat ada follow baru
//
// Methods:
// - created(Follow \$follow) Increment counts & buat notifikasi
// - deleted(Follow \$follow) Decrement counts
//
class FollowObserver
{
    public function __construct(protected NotificationService $notificationService) {}

    /**
     * Handle the Follow "created" event.
     */
    public function created(Follow $follow): void
    {
        // Increment following_count untuk user yang follow
        $follow->follower()->increment('following_count');

        // Increment followers_count untuk user yang di-follow
        $follow->following()->increment('followers_count');

        // Kirim notifikasi ke user yang di-follow via service
        $this->notificationService->notifyFollow($follow->follower_id, $follow->following_id);
    }

    /**
     * Handle the Follow "deleted" event.
     */
    public function deleted(Follow $follow): void
    {
        // Decrement following_count untuk user yang follow
        $follow->follower()->decrement('following_count');

        // Decrement followers_count untuk user yang di-follow
        $follow->following()->decrement('followers_count');

        // Hapus notifikasi via service
        $this->notificationService->deleteNotification('follow', $follow->follower_id, $follow->following_id);
    }
}
