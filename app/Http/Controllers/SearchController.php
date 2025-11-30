<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // ... method index biarkan saja ...

    // Method ini yang dipakai oleh Search Drawer (Alpine.js)
    public function suggestions(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([]);
        }

        // Cari user
        $users = User::where('username', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->limit(10) // Limit 10 biar ringan
            ->get();

        // KITA FORMAT ULANG DATANYA AGAR FRONTEND TIDAK PUSING
        $formattedUsers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                // Pastikan username ada, jika tidak pakai nama tanpa spasi
                'username' => $user->username ?? strtolower(str_replace(' ', '', $user->name)),

                // Logika Avatar: Jika user punya avatar di DB, pakai itu. Jika tidak, pakai UI Avatars.
                'avatar' => $user->avatar
                    ? asset('storage/' . $user->avatar)
                    : "https://ui-avatars.com/api/?name={$user->name}&background=random",

                // Link menuju profil user tersebut
                'profile_url' => route('profile.show', $user->username), // Gunakan username
            ];
        });

        return response()->json($formattedUsers);
    }
}
