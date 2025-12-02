<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
        ]);

        // Prevent duplicate skills
        $exists = Auth::user()->skills()->where('name', $request->name)->exists();

        if (!$exists) {
            Auth::user()->skills()->create([
                'name' => $request->name
            ]);
        }

        return back()->with('status', 'skill-added');
    }

    public function destroy(Skill $skill)
    {
        // Ensure the user owns the skill before deleting
        if ($skill->user_id === Auth::id()) {
            $skill->delete();
        }

        return back()->with('status', 'skill-deleted');
    }
}