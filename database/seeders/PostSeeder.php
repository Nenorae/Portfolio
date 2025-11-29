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
            $jumlahPost = rand(1, 3);
            for ($j = 0; $j < $jumlahPost; $j++) {
                DB::table('posts')->insert([
                    'user_id'     => $userId,
                    'title'       => $faker->sentence(4),
                    'caption'     => $faker->paragraph,
                    'github_link' => 'https://github.com/' . $faker->userName,
                    'likes_count' => 0, 
                    'created_at'  => $faker->dateTimeBetween('-1 month', 'now'),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}