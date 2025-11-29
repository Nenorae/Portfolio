<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // User Admin
        DB::table('users')->insert([
            'username'      => 'admin_portfolio',
            'email'         => 'admin@portfolio.com',
            'password'      => Hash::make('password'),
            'nim'           => '1234567890',
            'full_name'     => 'Administrator Portfolio',
            'bio'           => 'Akun utama.',
            'location'      => 'Surabaya',
            'website'       => 'https://portfolio.id',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // User Dummy
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'username'      => $faker->unique()->userName,
                'email'         => $faker->unique()->safeEmail,
                'password'      => Hash::make('password'),
                'nim'           => $faker->unique()->numerify('##########'),
                'full_name'     => $faker->name,
                'location'      => $faker->city,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}