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

        // Ambil semua User ID
        $userIds = DB::table('users')->pluck('id');

        // Daftar Kategori Project Mahasiswa PENS
        $categories = ['IoT', 'Web Development', 'Mobile App', 'Game Dev', 'Network Sec', 'UI/UX Design'];

        foreach ($userIds as $userId) {
            $jumlahPost = rand(1, 4); // 1-4 post per user

            for ($j = 0; $j < $jumlahPost; $j++) {

                // Pilih kategori random
                $selectedCategory = $faker->randomElement($categories);

                // Judul yang relevan dengan kategori (Simulasi)
                $title = "Project " . $selectedCategory . " - " . $faker->words(3, true);

                // Gambar random dari Picsum
                $randomId = rand(1, 1000);
                $imageUrl = "https://picsum.photos/seed/{$randomId}/800/600";

                DB::table('posts')->insert([
                    'user_id'     => $userId,
                    'title'       => ucwords($title),
                    'caption'     => $faker->paragraph(3), // Deskripsi agak panjang ala LinkedIn
                    'image'       => $imageUrl,

                    // Isi Data Portofolio
                    'category'    => $selectedCategory,
                    'github_link' => 'https://github.com/' . $faker->userName . '/project-' . $j,
                    'demo_link'   => ($j % 2 == 0) ? 'https://demo-project.com/view/' . $j : null, // 50% chance ada demo link

                    'likes_count' => rand(5, 100),
                    'created_at'  => $faker->dateTimeBetween('-6 months', 'now'),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
