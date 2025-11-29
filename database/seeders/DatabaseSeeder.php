<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset Database
        Schema::disableForeignKeyConstraints();
        DB::table('notifications')->truncate();
        DB::table('likes')->truncate();
        DB::table('follows')->truncate();
        DB::table('posts')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Panggil Seeder per File
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            FollowSeeder::class, // Didalamnya sekalian buat Notifikasi Follow
            LikeSeeder::class,   // Didalamnya sekalian buat Notifikasi Like
        ]);

        // 3. Sync Counters (Dilakukan terakhir disini agar akurat)
        $this->command->info('Sinkronisasi counters...');
        
        $userIds = DB::table('users')->pluck('id');
        foreach ($userIds as $uid) {
            DB::table('users')->where('id', $uid)->update([
                'followers_count' => DB::table('follows')->where('following_id', $uid)->count(),
                'following_count' => DB::table('follows')->where('follower_id', $uid)->count(),
                'posts_count'     => DB::table('posts')->where('user_id', $uid)->count(),
            ]);
        }

        $postIds = DB::table('posts')->pluck('id');
        foreach ($postIds as $pid) {
            DB::table('posts')->where('id', $pid)->update([
                'likes_count' => DB::table('likes')->where('post_id', $pid)->count(),
            ]);
        }
        
        $this->command->info('Semua Seeder Selesai!');
    }
}