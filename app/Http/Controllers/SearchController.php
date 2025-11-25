<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // index(Request $request) GET: Search user
    public function index(Request $request)
    {
        $query = $request->input('q');

        $users = [];
        if ($query) {
            // Search user berdasarkan username atau nama lengkap
            $users = User::where('username', 'like', "%{$query}%")
                         ->orWhere('name', 'like', "%{$query}%")
                         ->get();
        }

        // Menampilkan hasil pencarian
        return view('search.index', compact('users', 'query'));
    }

    // suggestions(Request $request) GET: Autocomplete suggestions (opsional)
    public function suggestions(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query) {
            return response()->json([]);
        }

        $users = User::where('username', 'like', "%{$query}%")
                     ->orWhere('name', 'like', "%{$query}%")
                     ->limit(5)
                     ->get(['id', 'name', 'username', 'avatar']);

        return response()->json($users);
    }
}


//
// Tugas:
// - Search user berdasarkan username atau nama lengkap
// - Menampilkan hasil pencarian
//
// Methods:
// - index(Request \$request) GET: Search user
// - suggestions(Request \$request) GET: Autocomplete suggestions (opsional)
//
