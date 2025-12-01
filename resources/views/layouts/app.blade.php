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

    <style>
        /* [Scrollbar styles remain] */
        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
        }

        html,
        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* CSS Tambahan untuk Floating Button */
        .floating-btn {
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            animation: floatPulse 3s infinite;
        }
        .floating-btn:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 0 25px rgba(37, 99, 235, 0.6);
        }
        @keyframes floatPulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(37, 99, 235, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-black text-gray-900 dark:text-white transition-colors duration-300">

    <div x-data="{ searchOpen: false, notificationOpen: false }" class="flex min-h-screen text-gray-900 dark:text-white transition-colors duration-300">

        <div class="hidden md:block w-[72px] xl:w-[245px] border-r border-gray-300 dark:border-[#262626] relative flex-shrink-0 bg-white dark:bg-black transition-colors duration-300">
            <div class="fixed top-0 left-0 h-full w-[72px] xl:w-[245px] overflow-y-auto no-scrollbar">
                <x-sidebar />
            </div>
        </div>

        <x-search-drawer />
        <x-notification-drawer />
        
        <div class="block md:hidden fixed top-0 w-full z-50 bg-white dark:bg-black border-b border-gray-300 dark:border-[#262626] transition-colors duration-300">
            @include('layouts.navigation')
        </div>

        <main class="flex-1 flex justify-center w-full bg-gray-100 dark:bg-black min-h-screen transition-colors duration-300">
            {{-- Perbaikan Lebar: max-w-[630px] dihapus --}}
            <div class="w-full pt-20 md:pt-8 pb-20 px-4 sm:px-6"> 

                @isset($header)
                <header class="bg-gray-100 dark:bg-black border-b border-gray-300 dark:border-[#262626] md:hidden mb-4 transition-colors duration-300">
                    <div class="py-4 px-4 text-gray-900 dark:text-white font-bold">
                        {{ $header }}
                    </div>
                </header>
                @endisset

                {!! $slot !!}
            </div>
        </main>

        <div class="hidden lg:block w-[380px] pl-10 pt-8 flex-shrink-0 bg-gray-100 dark:bg-black transition-colors duration-300">
            <div class="fixed w-[320px]">
                <x-right-sidebar />
            </div>
        </div>

    </div>
    
    {{-- TOMBOL FLOATING (Buat Karya) tetap di sini --}}
    <a href="{{ route('posts.create') }}" class="btn btn-primary rounded-circle shadow-lg position-fixed bottom-0 end-0 m-4 d-flex align-items-center justify-content-center floating-btn" 
       style="width: 60px; height: 60px; z-index: 1050; border: none; background: linear-gradient(45deg, #2563eb, #3b82f6);">
        <i class="bi bi-plus-lg fs-2 text-white"></i>
    </a>
    
    {{-- SCRIPT PENGATUR TEMA --}}
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        var themeToggleBtn = document.getElementById('theme-toggle');

        const theme = localStorage.getItem('color-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (theme === 'dark' || (!theme && prefersDark)) {
            document.documentElement.classList.add('dark');
            if (themeToggleLightIcon && themeToggleDarkIcon) {
                themeToggleLightIcon.classList.remove('hidden'); 
                themeToggleDarkIcon.classList.add('hidden'); 
            }
        } else {
            document.documentElement.classList.remove('dark');
            if (themeToggleLightIcon && themeToggleDarkIcon) {
                themeToggleDarkIcon.classList.remove('hidden'); 
                themeToggleLightIcon.classList.add('hidden'); 
            }
        }
        
        if (themeToggleBtn) { 
            themeToggleBtn.addEventListener('click', function() {
                const isCurrentlyDark = document.documentElement.classList.contains('dark');
                
                if (isCurrentlyDark) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }

                if (themeToggleDarkIcon && themeToggleLightIcon) {
                    themeToggleDarkIcon.classList.toggle('hidden');
                    themeToggleLightIcon.classList.toggle('hidden');
                }
            });
        }
    </script>

    {{-- SCRIPT AJAX LIKE (DITAMBAHKAN DISINI) --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const likeForms = document.querySelectorAll('.like-form');

        likeForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah refresh halaman / layar hitam JSON

                const url = this.action;
                // Ambil method asli (POST/DELETE) dari input hidden _method jika ada, atau default POST
                const methodInput = this.querySelector('input[name="_method"]');
                const method = methodInput ? methodInput.value : 'POST';
                
                const button = this.querySelector('button');
                const icon = button.querySelector('svg');
                const counter = button.querySelector('span'); 
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(url, {
                    method: 'POST', 
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: method 
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Update Tampilan Berdasarkan Response JSON
                    if (data.liked) {
                        // User baru saja LIKE
                        button.classList.remove('hover:text-red-500');
                        button.classList.add('text-red-500');
                        icon.setAttribute('fill', 'currentColor');
                        
                        // Ubah URL action ke route UNLIKE
                        this.action = url.replace('/like', '/unlike');
                        
                        // Tambahkan input hidden DELETE untuk klik berikutnya
                        if (!this.querySelector('input[name="_method"]')) {
                            const hiddenMethod = document.createElement('input');
                            hiddenMethod.type = 'hidden';
                            hiddenMethod.name = '_method';
                            hiddenMethod.value = 'DELETE';
                            this.appendChild(hiddenMethod);
                        } else {
                            this.querySelector('input[name="_method"]').value = 'DELETE';
                        }
                    } else {
                        // User baru saja UNLIKE
                        button.classList.remove('text-red-500');
                        button.classList.add('hover:text-red-500');
                        icon.setAttribute('fill', 'none');

                        // Ubah URL action ke route LIKE
                        this.action = url.replace('/unlike', '/like');
                        
                        // Hapus/Ubah input hidden _method jadi POST (atau hapus elemennya)
                        const hiddenMethod = this.querySelector('input[name="_method"]');
                        if (hiddenMethod) hiddenMethod.remove();
                    }

                    // Update Angka
                    if(counter) counter.innerText = data.likes_count;
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
    </script>

</body>
</html>