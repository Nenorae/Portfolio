<nav class="flex flex-col h-full justify-between">
    <div>
        <div class="mb-10 px-4 mt-4 hidden xl:block">
            <a href="{{ route('dashboard') }}" class="block">
                <span class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">MahaKarya</span>
            </a>
        </div>
        <div class="mb-10 px-4 mt-4 xl:hidden flex justify-center">
            <a href="{{ route('dashboard') }}" class="block">
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-purple-400 to-pink-600 flex items-center justify-center font-bold text-white text-lg">M</div>
            </a>
        </div>

        <div class="space-y-2 px-2">
            @php
            $menus = [
            // Menu-menu ini harusnya ada route yang benar ke controller, bukan '#'
            ['icon' => 'M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z', 'label' => 'Beranda', 'route' => 'dashboard'],
            ['icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'label' => 'Cari', 'route' => 'search.users'], // Mengganti '#' menjadi route search (asumsi)
            ['icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'label' => 'Pesan', 'route' => '#'],
            ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'label' => 'Notifikasi', 'route' => '#'],
            ['icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6', 'label' => 'Buat Karya', 'route' => 'posts.index'], // Mengganti '#' menjadi route gallery view
            ];
            @endphp

            @foreach($menus as $menu)
            
            {{-- Hover Class Dinamis --}}
            @php
                $hoverClass = 'hover:bg-gray-100 dark:hover:bg-white/10';
                $textClass = 'text-gray-800 dark:text-white'; // FIX TEXT COLOR
            @endphp

            {{-- LOGIKA UNTUK TOMBOL CARI (DIPERBAIKI LOGIKA KLIKNYA) --}}
            @if($menu['label'] === 'Cari')
            <div @click="searchOpen = !searchOpen; notificationOpen = false"
                class="cursor-pointer flex items-center gap-4 px-3 py-3 rounded-xl transition-all group {{ $hoverClass }}"
                :class="searchOpen ? 'border border-gray-300 dark:border-white/20 bg-gray-100 dark:bg-white/10' : ''"> 
                <svg class="w-7 h-7 {{ $textClass }} group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}" />
                </svg>
                <span class="hidden xl:block font-medium {{ $textClass }}">{{ $menu['label'] }}</span>
            </div>

            {{-- LOGIKA UNTUK TOMBOL NOTIFIKASI (DIPERBAIKI LOGIKA KLIKNYA) --}}
            @elseif($menu['label'] === 'Notifikasi')
            <div @click="notificationOpen = !notificationOpen; searchOpen = false"
                class="cursor-pointer flex items-center gap-4 px-3 py-3 rounded-xl transition-all group {{ $hoverClass }}"
                :class="notificationOpen ? 'border border-gray-300 dark:border-white/20 bg-gray-100 dark:bg-white/10' : ''">

                <div class="relative">
                    <svg class="w-7 h-7 {{ $textClass }} group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}" />
                    </svg>
                    @if(Auth::user()->unreadNotifications->count() > 0)
                    <div class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white dark:border-black"></div>
                    @endif
                </div>
                <span class="hidden xl:block font-medium {{ $textClass }}">{{ $menu['label'] }}</span>
            </div>

            {{-- LOGIKA UNTUK MENU STANDAR (Beranda, Pesan, Buat Karya) --}}
            @else
            <a href="{{ $menu['route'] == '#' ? '#' : route($menu['route']) }}"
                class="flex items-center gap-4 px-3 py-3 rounded-xl transition-all group {{ $hoverClass }}">
                <svg class="w-7 h-7 {{ $textClass }} group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}" />
                </svg>
                <span class="hidden xl:block font-medium {{ $textClass }}">{{ $menu['label'] }}</span>
            </a>
            @endif
            @endforeach

            {{-- LINK PROFIL (di bawah menu) --}}
            <a href="{{ route('profile.show', ['username' => Auth::user()->username]) }}" class="flex items-center gap-4 px-3 py-3 rounded-xl transition-all group {{ $hoverClass }}">
                <div class="w-7 h-7 rounded-full bg-gray-600 overflow-hidden border border-transparent group-hover:border-blue-400 transition-all">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random&color=fff" class="w-full h-full object-cover">
                    @endif
                </div>
                <span class="hidden xl:block font-medium {{ $textClass }}">Profil</span>
            </a>
        </div>
    </div>

    {{-- MENU LAINNYA (paling bawah) --}}
    <div class="mb-4 px-2">
        {{-- TOMBOL SAKLAR THEME BARU --}}
        <button id="theme-toggle" type="button" class="flex w-full items-center gap-4 px-3 py-3 rounded-xl transition-all group {{ $hoverClass }}">
            {{-- Ikon Matahari (Light) --}}
            <svg id="theme-toggle-light-icon" class="w-7 h-7 {{ $textClass }} group-hover:scale-105 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h1a1 1 0 100 2h-1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
            {{-- Ikon Bulan (Dark) --}}
            <svg id="theme-toggle-dark-icon" class="w-7 h-7 {{ $textClass }} group-hover:scale-105 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <span class="hidden xl:block font-medium {{ $textClass }}">Ganti Tema</span>
        </button>
        
        {{-- Tombol Lainnya (DIHAPUS DARI SINI) --}}
        {{-- <button class="flex w-full items-center gap-4 px-3 py-3 rounded-xl transition-all group {{ $hoverClass }}">
            <svg class="w-7 h-7 {{ $textClass }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="hidden xl:block font-medium {{ $textClass }}">Lainnya</span>
        </button> --}}
    </div>
</nav>