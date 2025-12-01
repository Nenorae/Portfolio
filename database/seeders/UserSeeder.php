<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // KUNCI: TRUNCATE untuk memastikan ID 1 kosong sebelum diisi dummy
        User::truncate(); 

        // 1. Buat User Dummy (50 Akun)
        $faker = Faker::create('id_ID');
        $jumlah_dummy = 50; 

        for ($i = 1; $i <= $jumlah_dummy; $i++) {
            User::create([
                'name'      => $faker->name,
                'username'  => $faker->unique()->userName,
                'email'     => $faker->unique()->safeEmail,
                'password'  => Hash::make('password'), // Semua dummy pakai password: 'password'
                
                // Field Tambahan (Sesuai UserFactory yang sudah kita edit)
                'bio'       => $faker->sentence(15), 
                'website'   => $faker->optional(0.6)->url(),
                'nim' => $faker->unique()->numerify('########'),
                'profile_photo' => null,
            ]);
        }
        
        // CATATAN PENTING:
        // Akun Asli Anda harus Dibuat Secara Manual (Register)
        // Setelah Anda menjalankan php artisan migrate:refresh --seed.
    }
}