<div
    x-show="searchOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="-translate-x-full opacity-0"
    
    {{-- FIX TEMA: BACKGROUND, BORDER, DAN TEXT HARUS DINAMIS --}}
    class="fixed top-0 left-[72px] xl:left-[245px] z-40 h-full w-[397px] bg-white dark:bg-black border-r border-gray-300 dark:border-[#262626] rounded-r-2xl shadow-2xl overflow-hidden transition-colors duration-300"
    style="display: none;"

    {{-- LOGIKA PENCARIAN ALPINE --}}
    x-data="{
        query: '',
        results: [],
        isLoading: false,
        
        async fetchUsers() {
            if (this.query.length < 1) {
                this.results = [];
                return;
            }
            
            this.isLoading = true;
            
            try {
                const response = await fetch(`{{ route('search.users') }}?q=${this.query}`);
                const data = await response.json();
                this.results = data;
            } catch (error) {
                console.error('Error fetching users:', error);
            } finally {
                this.isLoading = false;
            }
        },
        
        clearSearch() {
            this.query = '';
            this.results = [];
        }
    }">
    <div class="flex flex-col h-full">

        <div class="p-6 border-b border-gray-300 dark:border-[#262626] transition-colors duration-300">
            <h2 class="text-2xl font-bold mb-8 mt-2 text-gray-900 dark:text-white transition-colors duration-300">Cari</h2>

            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                {{-- FIX INPUT STYLE --}}
                <input type="text"
                    x-model="query"
                    @input.debounce.300ms="fetchUsers()"
                                class="block w-full p-3 pl-10 text-sm rounded-lg border-none focus:ring-0
                     text-gray-900 dark:text-white bg-gray-200 dark:bg-[#262626] 
                     placeholder-gray-600 dark:placeholder-gray-400 transition-colors duration-300"
                     placeholder="Cari pengguna...">

                <div x-show="isLoading" class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="animate-spin h-4 w-4 text-gray-700 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>

                <div x-show="query.length > 0 && !isLoading"
                    @click="clearSearch()"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer rounded-full p-1 m-2"
                    style="display: none;">
                    <div class="bg-gray-400/50 rounded-full p-0.5">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar pt-4">

            <div x-show="query.length === 0">
                <div class="flex justify-between items-center px-6 mb-4">
                    <h3 class="text-md font-bold text-gray-900 dark:text-white transition-colors duration-300">Baru saja</h3>
                    <button class="text-sm font-bold text-blue-500 hover:text-blue-700 dark:hover:text-white">Hapus semua</button>
                </div>
               <div class="px-6 py-4 text-gray-600 dark:text-gray-500 text-sm text-center">
                    Tidak ada riwayat pencarian terbaru.
                </div>
            </div>

            <div x-show="query.length > 0">

                <template x-for="user in results" :key="user.id">
                    <a :href="user.profile_url" class="flex items-center justify-between px-6 py-3 hover:bg-gray-100 dark:hover:bg-white/5 cursor-pointer transition-colors block">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-full bg-gray-200 dark:bg-gray-800 overflow-hidden border border-transparent dark:border-[#262626]">
                                <img :src="user.avatar" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-sm text-gray-900 dark:text-white" x-text="user.username"></p>
                                <p class="text-sm text-gray-500 dark:text-gray-400" x-text="user.name"></p>
                            </div>
                        </div>
                    </a>
                </template>

                <div x-show="results.length === 0 && !isLoading" class="px-6 py-8 text-center">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ditemukan hasil untuk "<span x-text="query" class="font-bold text-gray-900 dark:text-white"></span>"</p>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- FIX BACKDROP --}}
<div
    x-show="searchOpen"
    @click="searchOpen = false"
    class="fixed inset-0 z-30 bg-black/20 dark:bg-black/50 backdrop-blur-sm lg:hidden transition-colors duration-300"
    style="display: none;"></div>