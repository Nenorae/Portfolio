<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white dark:bg-black p-6 relative overflow-hidden transition-colors duration-500">
        
        {{-- Background Glow Effect (Hanya muncul di Dark Mode biar Light Mode bersih) --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-0 dark:opacity-100 transition-opacity duration-500">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/20 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-600/20 rounded-full blur-[120px] animate-pulse"></div>
        </div>

        {{-- Card Register Minimalis --}}
        <div class="w-full max-w-md bg-white dark:bg-white/10 backdrop-blur-xl border border-gray-200 dark:border-white/20 rounded-3xl p-8 shadow-2xl relative z-10 transition-all duration-300">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">MahaKarya</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Bergabunglah dengan Kreator Indonesia</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Nama Lengkap</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        class="w-full bg-gray-50 dark:bg-black/30 border border-gray-300 dark:border-white/10 text-gray-900 dark:text-white rounded-xl px-4 py-3 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Nama Panggilan / Lengkap">
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                {{-- Username --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Username</label>
                    <input id="username" type="text" name="username" :value="old('username')" required
                        class="w-full bg-gray-50 dark:bg-black/30 border border-gray-300 dark:border-white/10 text-gray-900 dark:text-white rounded-xl px-4 py-3 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Username unik, cth: john_doe">
                    <x-input-error :messages="$errors->get('username')" class="mt-1" />
                </div>

                {{-- NIM --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">NIM</label>
                    <input id="nim" type="text" name="nim" :value="old('nim')" required
                        class="w-full bg-gray-50 dark:bg-black/30 border border-gray-300 dark:border-white/10 text-gray-900 dark:text-white rounded-xl px-4 py-3 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Contoh: 12345678">
                    <x-input-error :messages="$errors->get('nim')" class="mt-1" />
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Email Kampus</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                        class="w-full bg-gray-50 dark:bg-black/30 border border-gray-300 dark:border-white/10 text-gray-900 dark:text-white rounded-xl px-4 py-3 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="nama@universitas.ac.id">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full bg-gray-50 dark:bg-black/30 border border-gray-300 dark:border-white/10 text-gray-900 dark:text-white rounded-xl px-4 py-3 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Minimal 8 karakter">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full bg-gray-50 dark:bg-black/30 border border-gray-300 dark:border-white/10 text-gray-900 dark:text-white rounded-xl px-4 py-3 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Ulangi password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gray-900 dark:bg-gradient-to-r dark:from-blue-600 dark:to-purple-600 hover:bg-black dark:hover:from-blue-700 dark:hover:to-purple-700 text-white font-bold py-3.5 rounded-xl shadow-lg transform hover:-translate-y-0.5 transition-all">
                        Daftar Sekarang
                    </button>
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors">
                        Sudah punya akun? <span class="text-blue-600 dark:text-blue-400 hover:underline">Masuk di sini</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>