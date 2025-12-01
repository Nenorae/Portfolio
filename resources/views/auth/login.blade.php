<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white dark:bg-black p-6 relative overflow-hidden transition-colors duration-500">
        
        {{-- Background Glow Effect (Dark Mode Only) --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-0 dark:opacity-100 transition-opacity duration-500">
            <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-600/20 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-purple-600/20 rounded-full blur-[120px] animate-pulse"></div>
        </div>

        {{-- Card Login Minimalis --}}
        <div class="w-full max-w-md bg-white dark:bg-white/10 backdrop-blur-xl border border-gray-200 dark:border-white/20 rounded-3xl p-8 shadow-2xl relative z-10 transition-all duration-300">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">MahaKarya</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Selamat datang kembali, Kreator!</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email Address --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        class="w-full bg-gray-50 dark:bg-black/30 border border-gray-300 dark:border-white/10 text-gray-900 dark:text-white rounded-xl px-4 py-3 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="nama@kampus.ac.id">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full bg-gray-50 dark:bg-black/30 border border-gray-300 dark:border-white/10 text-gray-900 dark:text-white rounded-xl px-4 py-3 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-gray-900 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-gray-600 dark:text-gray-400">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-blue-600 dark:text-blue-400 hover:underline font-medium" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gray-900 dark:bg-gradient-to-r dark:from-blue-600 dark:to-purple-600 hover:bg-black dark:hover:from-blue-700 dark:hover:to-purple-700 text-white font-bold py-3.5 rounded-xl shadow-lg transform hover:-translate-y-0.5 transition-all">
                        Log in
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-bold">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>