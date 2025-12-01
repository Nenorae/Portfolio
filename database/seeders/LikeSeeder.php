<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();

        if ($users->isEmpty() || $posts->isEmpty()) {
            return;
        }

        foreach ($posts as $post) {
            // Ambil beberapa user random untuk nge-like post ini (kecuali yang punya post)
            // Ambil 0 sampai 5 liker per post
            $likers = $users->reject(fn($u) => $u->id === $post->user_id)
                            ->random(min(rand(0, 5), $users->count() - 1));

            foreach ($likers as $liker) {
                // Cek manual via DB biar hemat resource & hindari model events
                $exists = DB::table('likes')
                    ->where('user_id', $liker->id)
                    ->where('post_id', $post->id)
                    ->exists();

                if (!$exists) {
                    // 1. Insert Like Pakai DB::table (PENTING: INI BYPASS OBSERVER YANG ERROR)
                    DB::table('likes')->insert([
                        'user_id'    => $liker->id,
                        'post_id'    => $post->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // 2. Insert Notifikasi (SESUAI FORMAT BARU: UUID + JSON)
                    DB::table('notifications')->insert([
                        'id'              => Str::uuid()->toString(),       // Wajib UUID
                        'type'            => 'App\Notifications\PostLiked', // Class Name untuk Notifikasi Like
                        'notifiable_type' => 'App\Models\User',             // Model Penerima
                        'notifiable_id'   => $post->user_id,                // ID Penerima (Pemilik Post)
                        'data'            => json_encode([                  // Data masuk ke JSON
                            'actor_id'   => $liker->id,
                            'actor_name' => $liker->name,
                            'post_id'    => $post->id,
                            'message'    => $liker->name . ' menyukai postingan Anda.',
                        ]),
                        'read_at'         => null,
                        'created_at'      => now(),
                        'updated_at'      => now(),
                    ]);
                }
            }
        }
    }
}