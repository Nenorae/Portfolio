<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - MahaKarya</title>

    <!-- CDN Tailwind (Gunakan Vite/Mix di production) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#667eea',
                        secondary: '#764ba2',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #fff 0%, #667eea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Fix Autofill Browser Style */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #1a1a2e inset !important;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>

<body class="bg-black text-white font-sans antialiased">

    <!-- Update: Menambah padding atas (py-16 dan sm:py-24) agar tidak mepet atas -->
    <div class="min-h-screen flex flex-col justify-center items-center py-16 sm:py-24 bg-gradient-to-b from-[#1a1a2e] to-black px-4">

        <!-- Logo / Header -->
        <div class="mb-8 text-center">
            <a href="/" class="text-4xl font-extrabold gradient-text inline-block hover:scale-105 transition-transform duration-300">
                MahaKarya
            </a>
            <p class="mt-2 text-white/50 text-sm">Bergabunglah dengan Kreator Indonesia</p>
        </div>

        <!-- Glassmorphism Card -->
        <div class="w-full sm:max-w-md px-8 py-10 bg-white/5 border border-white/10 shadow-2xl backdrop-blur-xl rounded-2xl sm:rounded-3xl relative overflow-hidden">

            <!-- Dekorasi Background Blobs -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-secondary/20 rounded-full blur-3xl pointer-events-none"></div>

            <form method="POST" action="{{ route('register') }}" class="relative z-10 space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block font-medium text-sm text-white/80 mb-2">
                        {{ __('Nama Lengkap') }}
                    </label>
                    <input id="name"
                        class="block w-full px-4 py-3 rounded-xl bg-black/20 border border-white/10 text-white placeholder-white/30 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required autofocus autocomplete="name"
                        placeholder="Nama Panggilan / Lengkap" />
                    @error('name')
                    <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor Mahasiswa (Custom Field) -->
                <div>
                    <label for="nomor_mahasiswa" class="block font-medium text-sm text-white/80 mb-2">
                        {{ __('Nomor Mahasiswa') }}
                    </label>
                    <input id="nomor_mahasiswa"
                        class="block w-full px-4 py-3 rounded-xl bg-black/20 border border-white/10 text-white placeholder-white/30 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all"
                        type="text"
                        name="nomor_mahasiswa"
                        value="{{ old('nomor_mahasiswa') }}"
                        required autocomplete="off"
                        placeholder="Contoh: 12345678" />
                    @error('nomor_mahasiswa')
                    <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block font-medium text-sm text-white/80 mb-2">
                        {{ __('Email Kampus') }}
                    </label>
                    <input id="email"
                        class="block w-full px-4 py-3 rounded-xl bg-black/20 border border-white/10 text-white placeholder-white/30 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required autocomplete="username"
                        placeholder="nama@universitas.ac.id" />
                    @error('email')
                    <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-medium text-sm text-white/80 mb-2">
                        {{ __('Password') }}
                    </label>
                    <input id="password"
                        class="block w-full px-4 py-3 rounded-xl bg-black/20 border border-white/10 text-white placeholder-white/30 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all"
                        type="password"
                        name="password"
                        required autocomplete="new-password"
                        placeholder="Minimal 8 karakter" />
                    @error('password')
                    <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block font-medium text-sm text-white/80 mb-2">
                        {{ __('Konfirmasi Password') }}
                    </label>
                    <input id="password_confirmation"
                        class="block w-full px-4 py-3 rounded-xl bg-black/20 border border-white/10 text-white placeholder-white/30 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="new-password"
                        placeholder="Ulangi password" />
                    @error('password_confirmation')
                    <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="pt-4">
                    <button type="submit" class="w-full justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-gradient-to-r from-primary to-secondary hover:shadow-lg hover:shadow-primary/40 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:ring-offset-black transition-all duration-200">
                        {{ __('Daftar Sekarang') }}
                    </button>

                    <div class="mt-6 text-center text-sm text-white/50">
                        {{ __('Sudah punya akun?') }}
                        <a class="font-semibold text-white hover:text-primary transition-colors ml-1" href="{{ route('login') }}">
                            {{ __('Log in') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Footer Kecil -->
        <div class="mt-8 mb-8 text-white/20 text-xs">
            &copy; {{ date('Y') }} MahaKarya Platform.
        </div>
    </div>
</body>

</html>