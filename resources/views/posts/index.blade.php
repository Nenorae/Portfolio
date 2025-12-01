<x-app-layout>
    <div class="min-h-screen p-6 transition-colors duration-300">
        {{-- PASTIKAN x-data DI SINI UNTUK SCOPE GLOBAL --}}
        <div class="container mx-auto px-4"
             x-data="infiniteScroll"> 
            
            {{-- Header Section --}}
            <div class="flex justify-between items-end mb-8 border-b border-gray-800 dark:border-gray-800/50 pb-4">
                <div>
                    <h6 class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-1 transition-colors duration-300">Gallery Explore</h6>
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight transition-colors duration-300">Karya Mahasiswa</h1>
                </div>
                
                <a href="{{ route('posts.create') }}" class="
    /* **1. Estetika Dasar & Gradasi (Light Mode)** */
    bg-gradient-to-r from-gray-200 to-gray-300 
    hover:from-gray-400 hover:to-gray-500 
    
    /* MODIFIKASI INI: WARNA TEKS UNTUK LIGHT MODE */
    dark:text-black /* Teks hitam gelap untuk Light Mode */
    
    shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out

    /* **2. Dark Mode Estetika** */
    dark:from-blue-500 dark:to-blue-600 
    dark:hover:from-blue-600 dark:hover:to-blue-700 
    
    /* MODIFIKASI INI: WARNA TEKS UNTUK DARK MODE */
    dark:text-white /* Teks putih untuk Dark Mode */
    
    /* **3. Ukuran, Bentuk, dan Bayangan Estetik** */
    font-bold py-3 px-8 rounded-full 
    flex items-center space-x-2 
    ">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
    </svg>
    <span>Upload Karya</span>
</a>
            </div>

            {{-- Alert Notifikasi --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 dark:bg-green-900/30 border border-green-500/50 text-green-700 dark:text-green-400 p-4 rounded-xl flex items-center gap-3">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            {{-- GRID MASONRY STYLE (POSTS CONTAINER) --}}
            <div id="post-container" class="columns-2 lg:columns-3 gap-4"> 
                @include('posts._post-cards', ['posts' => $posts])
            </div>

            {{-- EMPTY STATE (Hanya ditampilkan jika array $posts kosong di load awal) --}}
            @if($posts->isEmpty() && $posts->currentPage() === 1)
                <div id="empty-state-section" class="col-span-full flex flex-col items-center justify-center py-20 text-center bg-white dark:bg-[#121212] rounded-xl border border-gray-300 dark:border-gray-800 transition-colors duration-300">
                    <div class="bg-gray-200 dark:bg-white/5 p-6 rounded-full mb-4 border border-gray-300 dark:border-white/10">
                        <svg class="h-16 w-16 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors duration-300">Belum ada karya</h3>
                    <p class="text-gray-700 dark:text-gray-400 mb-6 transition-colors duration-300">Jadilah yang pertama memamerkan karyamu!</p>
                    <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white hover:bg-blue-500 font-bold py-2 px-6 rounded-full transition-colors">
                        Mulai Upload
                    </a>
                </div>
            @endif

            {{-- LOADING INDICATOR & TRIGGER --}}
            <div id="load-more-trigger" 
                 x-show="hasMore" 
                 x-intersect.once="loadMore" 
                 class="flex justify-center items-center py-8">
                <svg x-show="isLoading" class="animate-spin -ml-1 mr-3 h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p x-show="!isLoading" class="text-gray-500 dark:text-gray-400">Scroll ke bawah untuk memuat lebih banyak...</p>
            </div>
            
            {{-- END OF CONTENT MESSAGE --}}
            <div x-show="!hasMore" class="text-center py-10">
                <p class="text-gray-500 dark:text-gray-400 font-semibold border-t border-gray-200 dark:border-gray-700 pt-4">Anda telah mencapai akhir konten.</p>
            </div>

        </div>
    </div>
</x-app-layout>

{{-- SCRIPT ALPINE.JS DAN PLUGIN INTERSECT --}}

{{-- 1. PASTIKAN PLUGIN INTERSECT DITAMBAH (Jika menggunakan CDN) --}}
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

{{-- 2. SCRIPT UTAMA INFINITE SCROLL --}}
<script>
    document.addEventListener('alpine:init', () => {
        
        // Ambil data PHP dan konversi menjadi JSON untuk keamanan.
        const initialData = {
            currentPage: {{ $posts->currentPage() }},
            lastPage: {{ $posts->lastPage() }},
            hasMore: {{ $posts->hasMorePages() ? 'true' : 'false' }},
            url: "{{ route('posts.index') }}" // URL rute
        };

        // KELUARKAN LOG PHP DI CONSOLE (CEK INI!)
        console.log('--- PHP Initial Data Check ---');
        console.log('Current Page (Start):', initialData.currentPage);
        console.log('Last Page:', initialData.lastPage);
        console.log('Has More Pages:', initialData.hasMore);
        console.log('------------------------------');

        Alpine.data('infiniteScroll', () => ({
            currentPage: initialData.currentPage,
            lastPage: initialData.lastPage,
            isLoading: false,
            hasMore: initialData.hasMore, 

            async loadMore() {
                // Hentikan jika sedang memuat atau tidak ada lagi halaman
                if (this.isLoading || !this.hasMore) {
                    console.log(`[LOAD ABORTED] Loading: ${this.isLoading}, Has More: ${this.hasMore}`);
                    return; 
                }

                this.isLoading = true;
                this.currentPage++;
                const nextPage = this.currentPage;
                
                console.log(`[LOAD START] Requesting page ${nextPage}...`);

                try {
                    // Gunakan URL yang sudah disimpan
                    const url = `${initialData.url}?page=${nextPage}`;

                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest', 
                            'Accept': 'text/html'
                        }
                    });

                    // 1. Cek jika response gagal (4xx atau 5xx)
                    if (!response.ok) {
                        this.hasMore = false; 
                        console.error(`[LOAD FAILED] Response Status: ${response.status}. Check Network Tab.`);
                        throw new Error(`Gagal memuat konten: ${response.status}`);
                    }

                    const newHtml = await response.text();
                    
                    // 2. Cek jika konten baru yang dimuat kosong
                    if (newHtml.trim() === '') {
                        console.log(`[LOAD STOPPED] Konten Halaman ${nextPage} Kosong. Akhir konten.`);
                        this.hasMore = false; 
                        return;
                    }

                    // 3. Menambahkan konten baru
                    document.getElementById('post-container').insertAdjacentHTML('beforeend', newHtml);
                    console.log(`[LOAD SUCCESS] Content from page ${nextPage} injected.`);
                    
                    // 4. Cek apakah sudah halaman terakhir
                    if (this.currentPage >= this.lastPage) {
                        this.hasMore = false;
                        console.log(`[LOAD FINISHED] Reached last page: ${this.lastPage}.`);
                    }

                } catch (error) {
                    console.error('[GENERAL ERROR]', error);
                    this.currentPage--; // Rollback
                } finally {
                    this.isLoading = false;
                    console.log(`[LOAD END] Current Page: ${this.currentPage}, Has More: ${this.hasMore}`);
                }
            },
        }));
    });
</script>