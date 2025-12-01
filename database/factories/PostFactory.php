<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Tambahkan import User

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        // Pilihan URL Gambar Dummy yang lebih variatif
        $placeholderImages = [
            'https://picsum.photos/seed/' . $this->faker->numberBetween(1, 1000) . '/600/800', 
            'https://picsum.photos/seed/' . $this->faker->numberBetween(1, 1000) . '/800/600',
            'https://placehold.co/800x600/2563EB/FFFFFF/png?text=Creative+Work',
        ];

        return [
            // User::all()->random()->id harus berjalan karena UserSeeder dipanggil lebih dulu
            'user_id' => User::all()->random()->id, 
            'title' => $this->faker->catchPhrase(),
            'caption' => $this->faker->paragraph(3),
            'image' => $this->faker->randomElement($placeholderImages),
            'github_link' => $this->faker->boolean(50) ? $this->faker->url() : null,
            'demo_link' => $this->faker->boolean(50) ? $this->faker->url() : null,
            // Perbaikan: Likes count dibuat lebih realistis dan tinggi (0-150)
            'likes_count' => $this->faker->numberBetween(1, 150), 
        ];
    }
}