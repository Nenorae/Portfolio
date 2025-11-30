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
            ['icon' => 'M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z', 'label' => 'Beranda', 'route' => 'dashboard'],
            ['icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'label' => 'Cari', 'route' => '#'],
            // Item 'Explore' sudah dihapus dari sini
            ['icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'label' => 'Pesan', 'route' => '#'],
            ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'label' => 'Notifikasi', 'route' => '#'],
            ['icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6', 'label' => 'Buat Karya', 'route' => '#'],
            ];
            @endphp

            @foreach($menus as $menu)
            <a href="{{ $menu['route'] == '#' ? '#' : route($menu['route']) }}"
                class="flex items-center gap-4 px-3 py-3 rounded-xl transition-all group hover:bg-white/10">
                <svg class="w-7 h-7 text-white group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}" />
                </svg>
                <span class="hidden xl:block font-medium text-white">{{ $menu['label'] }}</span>
            </a>
            @endforeach

            <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-xl transition-all group hover:bg-white/10">
                <div class="w-7 h-7 rounded-full bg-gray-600 overflow-hidden border border-transparent group-hover:border-white transition-all">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random&color=fff" class="w-full h-full object-cover">
                </div>
                <span class="hidden xl:block font-medium text-white">Profil</span>
            </a>
        </div>
    </div>

    <div class="mb-4 px-2">
        <button class="flex w-full items-center gap-4 px-3 py-3 rounded-xl transition-all group hover:bg-white/10">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="hidden xl:block font-medium text-white">Lainnya</span>
        </button>
    </div>
</nav>