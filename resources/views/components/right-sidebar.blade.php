<div class="flex flex-col h-[calc(100vh-120px)] justify-between sticky top-24">
    
    {{-- 1. BAGIAN ATAS: VISUAL VIDEO (VERTIKAL MEMANJANG) --}}
    <div class="w-full flex-1 bg-white dark:bg-[#121212] rounded-2xl border border-gray-200 dark:border-[#262626] shadow-sm overflow-hidden relative group">
        
        {{-- VIDEO BACKGROUND (FULL COVER) --}}
        <div class="absolute inset-0 w-full h-full bg-gray-50 dark:bg-[#0a0a0a]">
            
            {{-- VIDEO TAG HTML5 --}}
            {{-- Pastikan file video ada di public/videos/sidebar.mp4 --}}
            <video 
                autoplay 
                loop 
                muted 
                playsinline 
                class="absolute inset-0 w-full h-full object-cover"
                poster="https://ui-avatars.com/api/?name=Video&background=0D8ABC&color=fff" {{-- Fallback image --}}
            >
                {{-- Ganti 'videos/sidebar.mp4' dengan path/nama file video kamu --}}
                <source src="{{ asset('videos/sidebar.mp4') }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
            
            {{-- Overlay Gradient Hitam di Bawah (Supaya teks terbaca jelas) --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
        </div>

        {{-- KONTEN TEKS & TOMBOL (Posisi di Bawah/Bottom) --}}
        <div class="absolute bottom-0 left-0 w-full p-6 text-center z-10">
            <h3 class="text-xl font-bold text-white mb-2 drop-shadow-md">
                Mulai Berkarya! 🚀
            </h3>
            {{-- DIUBAH MENJADI TEXT-WHITE UNTUK VISIBILITAS MAKSIMAL --}}
            <p class="text-xs text-white mb-5 leading-relaxed drop-shadow-sm opacity-90">
                Jangan biarkan idemu hilang begitu saja. Abadikan sekarang di MahaKarya.
            </p>

            {{-- TOMBOL: Dibuat SELALU JELAS dengan bg-white --}}
            <a href="{{ route('posts.create') }}" class="block w-full py-3 rounded-xl bg-white text-gray-900 font-bold text-sm hover:bg-gray-100 transition-colors shadow-lg transform hover:-translate-y-1 duration-300">
                Upload Karyamu
            </a>
        </div>
    </div>

    {{-- 2. BAGIAN BAWAH: FOOTER (Copyright & Links) --}}
    <div class="mt-4 px-2"> 
        <div class="text-[10px] text-white-300 dark:text-white-600 text-center font-medium">
            &copy; 2025 ✦ MAHAKARYA INDONESIA
        </div>
    </div>
</div>