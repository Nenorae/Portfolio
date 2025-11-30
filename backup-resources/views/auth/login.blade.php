<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MahaKarya</title>

    <!-- Menggunakan CDN Tailwind untuk memastikan style berjalan sesuai contoh landing page -->
    <!-- Di production, sebaiknya gunakan Vite/Mix compile asset kamu -->
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

        /* Animasi smooth untuk input autofill browser agar tidak merusak tema gelap */
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

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-[#1a1a2e] to-black px-4">

        <!-- Logo / Header -->
        <div class="mb-8 text-center">
            <a href="/" class="text-4xl font-extrabold gradient-text inline-block hover:scale-105 transition-transform duration-300">
                MahaKarya
            </a>
            <p class="mt-2 text-white/50 text-sm">Welcome back, Creator!</p>
        </div>

        <!-- Glassmorphism Card -->
        <div class="w-full sm:max-w-md px-8 py-10 bg-white/5 border border-white/10 shadow-2xl backdrop-blur-xl rounded-2xl sm:rounded-3xl relative overflow-hidden">

            <!-- Dekorasi Background Blobs -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-secondary/20 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Session Status -->
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-400">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="relative z-10">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block font-medium text-sm text-white/80 mb-2">
                        {{ __('Email') }}
                    </label>
                    <input id="email"
                        class="block w-full px-4 py-3 rounded-xl bg-black/20 border border-white/10 text-white placeholder-white/30 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required autofocus autocomplete="username"
                        placeholder="nama@kampus.ac.id" />
                    @error('email')
                    <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <label for="password" class="block font-medium text-sm text-white/80 mb-2">
                        {{ __('Password') }}
                    </label>
                    <input id="password"
                        class="block w-full px-4 py-3 rounded-xl bg-black/20 border border-white/10 text-white placeholder-white/30 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all"
                        type="password"
                        name="password"
                        required autocomplete="current-password"
                        placeholder="••••••••" />
                    @error('password')
                    <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mt-6">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" class="rounded border-white/20 bg-white/5 text-primary shadow-sm focus:ring-primary focus:ring-offset-black" name="remember">
                        <span class="ms-2 text-sm text-white/60 group-hover:text-white/80 transition-colors">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a class="text-sm text-primary hover:text-white transition-colors hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mt-8">
                    <button type="submit" class="w-full justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-gradient-to-r from-primary to-secondary hover:shadow-lg hover:shadow-primary/40 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:ring-offset-black transition-all duration-200">
                        {{ __('Log in') }}
                    </button>
                </div>

                <!-- Register Link -->
                @if (Route::has('register'))
                <div class="mt-6 text-center text-sm text-white/50">
                    {{ __('Don\'t have an account?') }}
                    <a class="font-semibold text-white hover:text-primary transition-colors ml-1" href="{{ route('register') }}">
                        {{ __('Register here') }}
                    </a>
                </div>
                @endif
            </form>
        </div>

        <!-- Footer Kecil -->
        <div class="mt-8 text-white/20 text-xs">
            &copy; {{ date('Y') }} MahaKarya Platform.
        </div>
    </div>
</body>

</html>
