<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // Sesuaikan nama input dengan yang ada di Form Register temanmu
            // Jika form pakai name="full_name", ganti 'name' dibawah jadi 'full_name'
            'name' => ['required', 'string', 'max:255'], 
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'nim' => ['required', 'string', 'max:20', 'unique:'.User::class], // <--- VALIDASI NIM
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            // KIRI: Nama Kolom Database | KANAN: Nama Input dari Form
            'name' => $request->name,        
            'username' => $request->username,
            'nim' => $request->nim,          // <--- SIMPAN NIM
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}