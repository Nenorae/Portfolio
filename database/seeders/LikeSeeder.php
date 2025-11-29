<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = DB::table('users')->pluck('id');
        $postIds = DB::table('posts')->pluck('id');

        foreach ($userIds as $likerId) {
            // User nge-like 3-6 postingan acak
            $randomPosts = $postIds->random(rand(3, 6));

            foreach ($randomPosts as $targetPostId) {
                // Cek siapa pemilik post
                $postOwner = DB::table('posts')->where('id', $targetPostId)->value('user_id');
                
                if ($postOwner == $likerId) continue; // Skip like sendiri

                // Insert Like
                DB::table('likes')->insertOrIgnore([
                    'user_id'    => $likerId,
                    'post_id'    => $targetPostId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Langsung Insert Notifikasi
                DB::table('notifications')->insert([
                    'user_id'    => $postOwner,
                    'actor_id'   => $likerId,
                    'type'       => 'like',
                    'post_id'    => $targetPostId,
                    'is_read'    => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}