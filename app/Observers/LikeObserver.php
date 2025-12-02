<?php

namespace App\Observers;

use App\Models\Like;
use App\Services\NotificationService;

class LikeObserver
{
    public function __construct(protected NotificationService $notificationService) {}

    /**
     * Handle the Like "created" event.
     */
    public function created(Like $like): void
    {
        // Increment likes_count on the post
        $like->post()->increment('likes_count');

        // Send a notification via service
        $this->notificationService->notifyLike($like->user_id, $like->post_id);
    }

    /**
     * Handle the Like "deleted" event.
     */
    public function deleted(Like $like): void
    {
        // Decrement likes_count on the post
        $like->post()->decrement('likes_count');

        // Delete the associated notification via service
        $this->notificationService->deleteNotification(
            'like',
            $like->user_id,
            $like->post->user_id,
            $like->post_id
        );
    }
}
