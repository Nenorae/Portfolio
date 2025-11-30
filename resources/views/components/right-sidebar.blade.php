<div class="text-white">
    <div class="bg-[#262626] rounded-lg px-4 py-2 mb-6 flex items-center gap-3 border border-transparent focus-within:border-gray-500 transition-all">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input type="text" placeholder="Cari" class="bg-transparent border-none text-sm text-white focus:ring-0 w-full p-0 placeholder-gray-400">
    </div>

    <div class="mb-4">
        <div class="flex justify-between items-center mb-4 px-1">
            <h3 class="font-bold text-gray-400 text-sm">Kreator Trending</h3>
            <button class="text-white text-xs font-bold">Lihat Semua</button>
        </div>

        <div class="space-y-4">
            @foreach(range(1, 3) as $i)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $i==1 ? 'from-purple-500 to-indigo-500' : ($i==2 ? 'from-pink-500 to-rose-500' : 'from-yellow-400 to-orange-500') }}"></div>
                    <div class="leading-tight">
                        <p class="font-bold text-sm hover:underline cursor-pointer text-white">
                            {{ $i==1 ? 'Komunitas IT' : ($i==2 ? 'DesignHub ID' : 'Startup Kampus') }}
                        </p>
                        <p class="text-xs text-gray-400">@ {{ $i==1 ? 'komunitas_it' : ($i==2 ? 'designhub' : 'startup_kmp') }}</p>
                    </div>
                </div>
                <button class="text-blue-400 text-xs font-bold hover:text-white transition-colors">Ikuti</button>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8 text-xs text-gray-500 space-y-4 px-1">
        <div class="flex flex-wrap gap-x-1 gap-y-1">
            <a href="#" class="hover:underline">Tentang</a> &bull;
            <a href="#" class="hover:underline">Bantuan</a> &bull;
            <a href="#" class="hover:underline">Pers</a> &bull;
            <a href="#" class="hover:underline">API</a> &bull;
            <a href="#" class="hover:underline">Karir</a> &bull;
            <a href="#" class="hover:underline">Privasi</a>
        </div>
        <p>© 2024 MAHAKARYA INDONESIA</p>
    </div>
</div>