<x-app-layout>
    <x-slot name="header"></x-slot>

    <!-- Script & Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#667eea',
                        secondary: '#764ba2',
                        dark: '#000000',
                        dark_panel: '#121212',
                    },
                    screens: {
                        'xs': '480px',
                    }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .gradient-text {
            background: linear-gradient(135deg, #fff 0%, #667eea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>

    <!-- Main Container: Full Width, Center Content -->
    <div class="min-h-screen bg-black text-white font-sans flex justify-center overflow-x-hidden">

        <!-- Responsive Wrapper: Mengatur lebar maksimal agar tidak terlalu stretch di monitor ultrawide -->
        <div class="flex w-full max-w-[1600px] gap-0 md:gap-4 lg:gap-8 justify-center">

            <!-- 1. LEFT SIDEBAR (Dynamic Width) -->
            <!-- Mobile: Hidden | Tablet: Icon Only (w-20) | Desktop: Full (w-64) -->
            <aside class="hidden md:flex flex-col sticky top-0 h-screen py-8 pl-4 border-r border-white/10 transition-all duration-300 w-20 xl:w-[280px]">

                <!-- Logo -->
                <div class="mb-10 px-2 xl:px-4 flex justify-center xl:justify-start">
                    <a href="/" class="group">
                        <!-- Icon Logo (Visible on Tablet) -->
                        <div class="xl:hidden w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center font-bold text-xl">M</div>
                        <!-- Full Logo (Visible on Desktop) -->
                        <span class="hidden xl:block text-3xl font-extrabold gradient-text group-hover:opacity-80 transition-opacity">MahaKarya</span>
                    </a>
                </div>

                <!-- Navigation Menu -->
                <nav class="space-y-2 flex-1 px-2">
                    @php
                    $menus = [
                    ['icon' => 'M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z', 'label' => 'Beranda', 'active' => true],
                    ['icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'label' => 'Cari', 'active' => false],
                    ['icon' => 'M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11', 'label' => 'Explore', 'active' => false],
                    ['icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'label' => 'Pesan', 'active' => false],
                    ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'label' => 'Notifikasi', 'active' => false],
                    ['icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6', 'label' => 'Buat Karya', 'active' => false],
                    ];
                    @endphp

                    @foreach($menus as $menu)
                    <a href="#" class="flex items-center justify-center xl:justify-start gap-4 px-3 py-3 rounded-xl transition-all group {{ $menu['active'] ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        <svg class="w-7 h-7 {{ $menu['active'] ? 'text-white' : 'text-white/60 group-hover:text-white' }} flex-shrink-0" fill="{{ $menu['active'] ? 'currentColor' : 'none' }}" stroke="{{ $menu['active'] ? 'none' : 'currentColor' }}" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}" />
                        </svg>
                        <span class="hidden xl:block font-medium {{ $menu['active'] ? 'text-white font-bold' : 'text-white/60 group-hover:text-white' }}">{{ $menu['label'] }}</span>
                    </a>
                    @endforeach
                </nav>

                <!-- User Profile -->
                <div class="mt-auto mb-4 px-2">
                    <a href="#" class="flex items-center justify-center xl:justify-start gap-3 p-3 hover:bg-white/5 rounded-xl transition-all">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary to-secondary flex-shrink-0"></div>
                        <div class="hidden xl:block overflow-hidden">
                            <p class="font-bold text-sm truncate w-32">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-white/50 truncate w-32">@ {{ strtolower(str_replace(' ', '', Auth::user()->name)) }}</p>
                        </div>
                        <div class="hidden xl:block ml-auto text-white/50">•••</div>
                    </a>
                </div>
            </aside>

            <!-- 2. MAIN FEED (Fluid Width) -->
            <!-- Flex-1 allows it to take remaining space, max-w prevents looking too wide -->
            <main class="flex-1 w-full max-w-[640px] border-x border-white/10 min-h-screen">

                <!-- Sticky Header Mobile/Tablet -->
                <div class="sticky top-0 z-20 bg-black/80 backdrop-blur-md border-b border-white/10 p-4 flex justify-between items-center md:hidden">
                    <span class="text-xl font-extrabold gradient-text">MahaKarya</span>
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-primary to-secondary"></div>
                </div>

                <!-- Create Post Box -->
                <div class="p-4 border-b border-white/10 hidden md:block">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary to-secondary flex-shrink-0"></div>
                        <div class="flex-1">
                            <input type="text" placeholder="Apa yang sedang kamu kerjakan?" class="w-full bg-transparent border-none text-white placeholder-white/40 focus:ring-0 text-lg mb-4">
                            <div class="flex justify-between items-center">
                                <div class="flex gap-2 text-primary">
                                    <button class="p-2 hover:bg-primary/10 rounded-full transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg></button>
                                    <button class="p-2 hover:bg-primary/10 rounded-full transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                        </svg></button>
                                </div>
                                <button class="bg-primary text-white px-6 py-2 rounded-full font-bold text-sm hover:opacity-90 transition-opacity">Posting</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feed Content -->
                <div class="divide-y divide-white/10">

                    <!-- Post 1 -->
                    <article class="p-4 hover:bg-white/[0.02] transition-colors cursor-pointer">
                        <div class="flex gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0"> <!-- min-w-0 prevents flex items from overflowing -->
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center gap-2 truncate">
                                        <span class="font-bold truncate">Sarah Desainer</span>
                                        <span class="text-white/40 text-sm">@sarahdsgn</span>
                                        <span class="text-white/40 text-sm">• 2j</span>
                                    </div>
                                    <button class="text-white/40 hover:text-white">•••</button>
                                </div>
                                <p class="mb-3 text-sm leading-relaxed">
                                    Baru aja kelar redesign aplikasi ojek online nih. Fokus di simplifikasi user flow biar ga bingung pas order makanan. Gimana menurut kalian? 🤔 <span class="text-primary">#uiux #design</span>
                                </p>

                                <!-- Content Image Container -->
                                <div class="w-full aspect-[4/3] bg-gradient-to-bl from-gray-800 to-gray-900 rounded-xl flex items-center justify-center border border-white/10 mb-3 overflow-hidden">
                                    <div class="text-center transform transition-transform hover:scale-105 duration-500">
                                        <span class="text-6xl drop-shadow-lg">🎨</span>
                                        <p class="text-white/40 mt-4 text-sm font-medium">App Mockup Preview</p>
                                    </div>
                                </div>

                                <!-- Action Bar -->
                                <div class="flex justify-between text-white/40 max-w-md">
                                    <button class="flex items-center gap-2 hover:text-primary transition-colors group">
                                        <div class="p-2 rounded-full group-hover:bg-primary/10 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs">12</span>
                                    </button>
                                    <button class="flex items-center gap-2 hover:text-green-500 transition-colors group">
                                        <div class="p-2 rounded-full group-hover:bg-green-500/10 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        </div>
                                        <span class="text-xs">4</span>
                                    </button>
                                    <button class="flex items-center gap-2 hover:text-pink-500 transition-colors group">
                                        <div class="p-2 rounded-full group-hover:bg-pink-500/10 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs">2.4k</span>
                                    </button>
                                    <button class="flex items-center gap-2 hover:text-primary transition-colors group">
                                        <div class="p-2 rounded-full group-hover:bg-primary/10 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Post 2 -->
                    <article class="p-4 hover:bg-white/[0.02] transition-colors cursor-pointer">
                        <div class="flex gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center gap-2 truncate">
                                        <span class="font-bold truncate">Rudi Code</span>
                                        <span class="text-white/40 text-sm">@rudicode</span>
                                        <span class="text-white/40 text-sm">• 5j</span>
                                    </div>
                                    <button class="text-white/40 hover:text-white">•••</button>
                                </div>
                                <p class="mb-3 text-sm leading-relaxed">
                                    Akhirnya nemu solusi buat bug yang bikin pusing 3 hari ini. Ternyata cuma masalah typo di variabel env. 🥲
                                </p>

                                <!-- Code Block Content -->
                                <div class="w-full bg-[#1e1e1e] rounded-xl p-4 font-mono text-xs overflow-x-auto border border-white/5 mb-3">
                                    <div class="flex gap-2 mb-2">
                                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                    </div>
                                    <pre><code class="language-javascript"><span class="text-purple-400">const</span> <span class="text-blue-400">debugLife</span> = () => {
  <span class="text-purple-400">if</span> (coffee === <span class="text-orange-400">0</span>) {
    <span class="text-yellow-300">panic</span>();
  } <span class="text-purple-400">else</span> {
    <span class="text-yellow-300">code</span>();
  }
}</code></pre>
                                </div>

                                <!-- Action Bar -->
                                <div class="flex justify-between text-white/40 max-w-md">
                                    <button class="flex items-center gap-2 hover:text-primary transition-colors group">
                                        <div class="p-2 rounded-full group-hover:bg-primary/10 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg></div>
                                        <span class="text-xs">45</span>
                                    </button>
                                    <button class="flex items-center gap-2 hover:text-green-500 transition-colors group">
                                        <div class="p-2 rounded-full group-hover:bg-green-500/10 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg></div>
                                        <span class="text-xs">12</span>
                                    </button>
                                    <button class="flex items-center gap-2 hover:text-pink-500 transition-colors group">
                                        <div class="p-2 rounded-full group-hover:bg-pink-500/10 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg></div>
                                        <span class="text-xs">8k</span>
                                    </button>
                                    <button class="flex items-center gap-2 hover:text-primary transition-colors group">
                                        <div class="p-2 rounded-full group-hover:bg-primary/10 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                            </svg></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>

                </div>
            </main>

            <!-- 3. RIGHT SIDEBAR (Fixed Width) -->
            <!-- Hidden on Tablet/Mobile, Visible only on Large Screens -->
            <aside class="hidden lg:block w-[350px] py-8 pl-8 sticky top-0 h-screen overflow-y-auto no-scrollbar">

                <!-- Search Bar -->
                <div class="bg-white/5 rounded-full px-5 py-3 mb-6 flex items-center gap-3 focus-within:bg-black focus-within:ring-1 focus-within:ring-primary border border-transparent focus-within:border-primary transition-all">
                    <svg class="w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Cari di MahaKarya" class="bg-transparent border-none text-sm text-white focus:ring-0 w-full p-0 placeholder-white/40">
                </div>

                <!-- Trending / Suggestions Card -->
                <div class="bg-white/5 rounded-2xl border border-white/10 p-4 mb-4">
                    <h3 class="font-extrabold text-lg mb-4">Kreator Trending</h3>

                    <div class="space-y-4">
                        @foreach(range(1, 3) as $i)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $i==1 ? 'from-purple-500 to-indigo-500' : ($i==2 ? 'from-pink-500 to-rose-500' : 'from-yellow-400 to-orange-500') }}"></div>
                                <div>
                                    <p class="font-bold text-sm hover:underline cursor-pointer">
                                        {{ $i==1 ? 'Komunitas IT' : ($i==2 ? 'DesignHub ID' : 'Startup Kampus') }}
                                    </p>
                                    <p class="text-xs text-white/40">@ {{ $i==1 ? 'komunitas_it' : ($i==2 ? 'designhub' : 'startup_kmp') }}</p>
                                </div>
                            </div>
                            <button class="bg-white text-black px-4 py-1.5 rounded-full text-sm font-bold hover:bg-opacity-90 transition-all">Ikuti</button>
                        </div>
                        @endforeach
                    </div>
                    <button class="text-primary text-sm mt-4 hover:underline">Tampilkan lebih banyak</button>
                </div>

                <!-- Footer -->
                <div class="text-xs text-white/30 leading-5 px-2">
                    <div class="flex flex-wrap gap-x-3 gap-y-1 mb-2">
                        <a href="#" class="hover:underline">Tentang</a>
                        <a href="#" class="hover:underline">Bantuan</a>
                        <a href="#" class="hover:underline">Pers</a>
                        <a href="#" class="hover:underline">API</a>
                        <a href="#" class="hover:underline">Karir</a>
                        <a href="#" class="hover:underline">Privasi</a>
                    </div>
                    <p>© 2024 MAHAKARYA INDONESIA</p>
                </div>
            </aside>

        </div>
    </div>
</x-app-layout>