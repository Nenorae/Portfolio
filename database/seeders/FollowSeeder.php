<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FollowSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua User (Kita butuh Model untuk fungsi attach() biar aman)
        $users = User::all();

        if ($users->count() < 2) {
            return;
        }

        foreach ($users as $follower) {
            // Random pick 2-5 user lain untuk difollow (kecuali diri sendiri)
            $targets = $users->reject(fn($u) => $u->id === $follower->id)
                             ->random(min(rand(2, 5), $users->count() - 1));
            
            foreach ($targets as $following) {
                // 1. Insert Follow (Pakai Eloquent biar nama tabel pivot otomatis benar)
                try {
                    // syncWithoutDetaching mencegah error duplicate entry
                    $follower->following()->syncWithoutDetaching([$following->id]);
                } catch (\Exception $e) {
                    continue; // Skip jika ada masalah
                }

                // 2. Insert Notifikasi (SESUAIKAN DENGAN STRUKTUR BARU)
                // Kita pakai DB::table manual biar cepat, tapi formatnya harus benar (UUID)
                DB::table('notifications')->insert([
                    'id'              => Str::uuid()->toString(),         // Wajib UUID
                    'type'            => 'App\Notifications\NewFollower', // Class Name
                    'notifiable_type' => 'App\Models\User',               // Polymorphic Type
                    'notifiable_id'   => $following->id,                  // ID Penerima (User yg difollow)
                    'data'            => json_encode([                    // Data masuk ke JSON
                        'actor_id'   => $follower->id,
                        'actor_name' => $follower->name,
                        'message'    => $follower->name . ' mulai mengikuti Anda.',
                    ]),
                    'read_at'         => null,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
            }
        }
    }
}