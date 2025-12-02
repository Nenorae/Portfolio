<?php

namespace App\Observers;

use App\Models\Follow;
use App\Services\NotificationService;

class FollowObserver
{
    public function __construct(protected NotificationService $notificationService) {}

    /**
     * Handle the Follow "created" event.
     */
    public function created(Follow $follow): void
    {
        // Increment following_count for the follower
        $follow->follower()->increment('following_count');

        // Increment followers_count for the user being followed
        $follow->following()->increment('followers_count');

        // Send a notification to the user being followed
        $this->notificationService->notifyFollow($follow->follower_id, $follow->following_id);
    }

    /**
     * Handle the Follow "deleted" event.
     */
    public function deleted(Follow $follow): void
    {
        // Decrement following_count for the follower
        $follow->follower()->decrement('following_count');

        // Decrement followers_count for the user being followed
        $follow->following()->decrement('followers_count');

        // Delete the associated notification
        $this->notificationService->deleteNotification('follow', $follow->follower_id, $follow->following_id);
    }
}
