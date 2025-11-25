<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Post;

//
// Tugas:
// - Logic untuk membuat notifikasi
// - Prevent self-notification
// - Batch create notifications
//
// Methods:
// - notifyFollow(\$followerId, \$followingId) Notifikasi follow
// - notifyLike(\$userId, \$postId) Notifikasi like
// - deleteNotification(\$type, \$actorId, \$targetId, \$postId = null) Hapus notifikasi
//
class NotificationService
{
    /**
     * Buat notifikasi untuk event follow.
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
     * Buat notifikasi untuk event like.
     */
    public function notifyLike(int $userId, int $postId): void
    {
        $post = Post::find($postId);

        // Pastikan post ada dan cegah notifikasi untuk like pada post sendiri
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
     * Hapus notifikasi terkait.
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
