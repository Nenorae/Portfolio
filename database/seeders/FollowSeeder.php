<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil User ID lagi
        $userIds = DB::table('users')->pluck('id');

        foreach ($userIds as $followerId) {
            // Random pick user lain
            $targets = $userIds->reject(fn($id) => $id == $followerId)->random(rand(2, 5));
            
            foreach ($targets as $followingId) {
                // Insert Follow
                DB::table('follows')->insertOrIgnore([
                    'follower_id'  => $followerId,
                    'following_id' => $followingId,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                // Langsung Insert Notifikasi
                DB::table('notifications')->insert([
                    'user_id'    => $followingId, // Penerima
                    'actor_id'   => $followerId,  // Pelaku
                    'type'       => 'follow',
                    'is_read'    => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}