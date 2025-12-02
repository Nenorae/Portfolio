<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Provide user search suggestions for the search drawer.
     */
    public function suggestions(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([]);
        }

        // Search for users by username or name
        $users = User::where('username', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->limit(10)
            ->get();

        // Format the user data for the frontend
        $formattedUsers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username ?? strtolower(str_replace(' ', '', $user->name)),
                // Use the user's avatar if available, otherwise use a UI avatar
                'avatar' => $user->avatar
                    ? asset('storage/' . $user->avatar)
                    : "https://ui-avatars.com/api/?name={$user->name}&background=random",
                'profile_url' => route('profile.show', $user->username),
            ];
        });

        return response()->json($formattedUsers);
    }
}
