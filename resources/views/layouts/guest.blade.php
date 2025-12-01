<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MahaKarya') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="font-sans text-gray-900 antialiased transition-colors duration-300 overflow-x-hidden">
        
        {{-- ==================================================== --}}
        {{-- ANIMASI GLOBAL: TRANSISI LINGKARAN (MASUK & KELUAR) --}}
        {{-- ==================================================== --}}
        {{-- Default State: MENUTUP LAYAR (w-[300vmax]) agar saat load tidak nge-blink --}}
        <div id="page-transition-circle" 
             class="fixed top-1/2 left-1/2 z-[9999] rounded-full 
                    w-[300vmax] h-[300vmax] 
                    bg-black dark:bg-white 
                    transform -translate-x-1/2 -translate-y-1/2 
                    transition-all duration-1000 ease-in-out pointer-events-none">
        </div>

        {{-- Wrapper Utama --}}
        <div class="min-h-screen bg-white dark:bg-black">
            {{ $slot }}
        </div>

        {{-- TOMBOL SAKLAR TEMA --}}
        <button id="theme-toggle" type="button" class="fixed bottom-5 right-5 z-50 p-3 rounded-full shadow-lg transition-all duration-300 bg-white text-gray-800 hover:bg-gray-100 dark:bg-gray-800 dark:text-white border border-gray-300 dark:border-gray-700">
            {{-- Ikon Matahari (Light) --}}
            <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h1a1 1 0 100 2h-1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
            {{-- Ikon Bulan (Dark) --}}
            <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
        </button>

        <script>
            // --- 1. LOGIKA ANIMASI TRANSISI (GLOBAL) ---
            const circle = document.getElementById('page-transition-circle');

            // A. SAAT HALAMAN DIMUAT (ANIMASI KELUAR/MENGECIL)
            window.addEventListener('DOMContentLoaded', () => {
                // Beri sedikit jeda agar browser merender background dulu
                setTimeout(() => {
                    circle.classList.remove('w-[300vmax]', 'h-[300vmax]');
                    circle.classList.add('w-0', 'h-0');
                }, 50);
            });

            // B. SAAT TOMBOL LINK DIKLIK (ANIMASI MASUK/MEMBESAR)
            document.addEventListener('click', (e) => {
                // Cari apakah yang diklik adalah link <a>
                const link = e.target.closest('a');
                
                // Jika link valid, internal, dan bukan sekedar anchor (#)
                if (link && link.href && link.hostname === window.location.hostname && !link.hash && !link.target) {
                    e.preventDefault(); // Tahan dulu pindah halamannya

                    // Mainkan animasi membesar
                    circle.classList.remove('w-0', 'h-0');
                    circle.classList.add('w-[300vmax]', 'h-[300vmax]');

                    // Pindah halaman setelah animasi selesai
                    setTimeout(() => {
                        window.location.href = link.href;
                    }, 800); 
                }
            });


            // --- 2. LOGIKA TEMA (DARK/LIGHT) ---
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
            var themeToggleBtn = document.getElementById('theme-toggle');

            const theme = localStorage.getItem('color-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            // Set Initial Theme
            if (theme === 'dark' || (!theme && prefersDark)) {
                document.documentElement.classList.add('dark');
                themeToggleLightIcon.classList.remove('hidden');
                themeToggleDarkIcon.classList.add('hidden');
            } else {
                document.documentElement.classList.remove('dark');
                themeToggleDarkIcon.classList.remove('hidden');
                themeToggleLightIcon.classList.add('hidden');
            }

            // Toggle Click
            themeToggleBtn.addEventListener('click', function() {
                const isCurrentlyDark = document.documentElement.classList.contains('dark');
                
                if (isCurrentlyDark) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }

                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');
            });
        </script>
    </body>
</html>