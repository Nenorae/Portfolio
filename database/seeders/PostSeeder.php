<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // AMBIL SEMUA USER ID DARI DATABASE
        $userIds = DB::table('users')->pluck('id');

        foreach ($userIds as $userId) {
            // Setiap user buat 1-3 postingan
            $jumlahPost = rand(1, 3);

            for ($j = 0; $j < $jumlahPost; $j++) {

                // Logika Gambar:
                // Kita pakai picsum.photos dengan 'seed' random agar gambar tidak sama semua.
                // Format: https://picsum.photos/seed/{random}/lebar/tinggi
                $randomId = rand(1, 9999);
                $imageUrl = "https://picsum.photos/seed/{$randomId}/800/600";

                DB::table('posts')->insert([
                    'user_id'     => $userId,
                    'title'       => $faker->sentence(4),
                    'caption'     => $faker->paragraph(2), // 2 paragraf biar agak panjang
                    'image'       => $imageUrl, // <-- INI YANG DITAMBAHKAN
                    'github_link' => 'https://github.com/' . $faker->userName,
                    'likes_count' => rand(10, 500), // Random likes biar terlihat hidup
                    'created_at'  => $faker->dateTimeBetween('-3 month', 'now'),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
