<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Post;

class NotificationService
{
    /**
     * Create a notification for a follow event.
     */
    public function notifyFollow(int $followerId, int $followingId): void
    {
        // Prevent self-notification
        if ($followerId === $followingId) {
            return;
        }

        Notification::create([
            'user_id' => $followingId,
            'actor_id' => $followerId,
            'type' => 'follow',
        ]);
    }

    /**
     * Create a notification for a like event.
     */
    public function notifyLike(int $userId, int $postId): void
    {
        $post = Post::find($postId);

        // Ensure the post exists and prevent self-notification for liking own post
        if (! $post || $userId === $post->user_id) {
            return;
        }

        Notification::create([
            'user_id' => $post->user_id,
            'actor_id' => $userId,
            'post_id' => $postId,
            'type' => 'like',
        ]);
    }

    /**
     * Delete an associated notification.
     */
    public function deleteNotification(string $type, int $actorId, int $targetId, ?int $postId = null): void
    {
        $query = Notification::where('type', $type)
            ->where('actor_id', $actorId)
            ->where('user_id', $targetId);

        if ($type === 'like' && $postId) {
            $query->where('post_id', $postId);
        }

        $query->delete();
    }
}
