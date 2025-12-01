<x-app-layout>
    <x-slot name="header"></x-slot>

    {{-- 1. HEADER SAPAAN (ANIMASI TYPEWRITER) --}}
    <div class="p-4 border-b border-gray-200 dark:border-[#262626] hidden md:block mb-4 transition-colors duration-300">
        <div class="flex gap-4 items-center">
            
            {{-- AVATAR USER --}}
            <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden flex-shrink-0 border border-gray-300 dark:border-gray-600">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                         class="w-full h-full object-cover" 
                         alt="{{ Auth::user()->name }}">
                @else
                    <img src="https://ui-avatars.com/api/?name={!! urlencode(Auth::user()->name) !!}&background=random" 
                         class="w-full h-full object-cover" 
                         alt="{{ Auth::user()->name }}">
                @endif
            </div>
            
            <div class="flex-1">
                {{-- LOGIKA WAKTU (WIB) --}}
                @php
                    $hour = now()->setTimezone('Asia/Jakarta')->hour;
                    if ($hour >= 3 && $hour < 11) { $sapa = "Selamat Pagi"; }
                    elseif ($hour >= 11 && $hour < 15) { $sapa = "Selamat Siang"; }
                    elseif ($hour >= 15 && $hour < 18) { $sapa = "Selamat Sore"; }
                    else { $sapa = "Selamat Malam"; }
                    
                    // Kalimat lengkap disimpan di variabel data attribute biar bisa diambil JS
                    $fullText = "$sapa, " . Auth::user()->name . "! Bagaimana kabarmu hari ini?";
                @endphp

                {{-- INPUT READONLY DENGAN ID UNTUK JS --}}
                <input type="text" 
                       id="typewriter-text"
                       data-text="{{ $fullText }}"
                       value="" 
                       readonly
                       class="w-full bg-transparent border-none text-gray-500 dark:text-gray-400 text-lg cursor-default focus:ring-0 px-0 py-2">
            </div>
        </div>
    </div>

    {{-- 2. POSTS CONTAINER --}}
    <div id="posts-container" class="divide-y divide-gray-200 dark:divide-[#262626]">

        @if($posts->count() > 0)

        @foreach($posts as $post)
        <article class="post-item p-4 hover:bg-gray-50 dark:hover:bg-white/[0.02] transition-colors cursor-pointer">
            <div class="flex gap-3">
                
                {{-- KOLOM KIRI: AVATAR PENULIS POST --}}
                <a href="{{ route('profile.show', $post->user->username) }}" class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex-shrink-0 overflow-hidden border border-gray-300 dark:border-gray-600">
                    @if($post->user->profile_photo)
                        <img src="{{ asset('storage/' . $post->user->profile_photo) }}" 
                             alt="{{ $post->user->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={!! urlencode($post->user->name) !!}&background=random" 
                             alt="{{ $post->user->name }}" 
                             class="w-full h-full object-cover">
                    @endif
                </a>

                {{-- KOLOM KANAN: KONTEN POST --}}
                <div class="flex-1 min-w-0">
                    {{-- Header Post --}}
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex items-center gap-2 truncate">
                            <a href="{{ route('profile.show', $post->user->username) }}">
                                <span class="font-bold truncate text-gray-900 dark:text-white transition-colors duration-300">{!! $post->user->name !!}</span>
                                <span class="text-gray-500 dark:text-white/40 text-sm">{!! $post->user->username !!}</span>
                            </a>
                            <span class="text-gray-500 dark:text-white/40 text-sm">• {!! $post->created_at->diffForHumans() !!}</span>
                        </div>
                        
                        {{-- Follow Button Logic --}}
                        @if(Auth::id() !== $post->user->id)
                            @if(Auth::user()->isFollowing($post->user))
                                <form action="{{ route('users.unfollow', $post->user) }}" method="POST" class="follow-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 text-gray-800 dark:text-white px-3 py-1 rounded-full text-xs font-semibold transition-colors">
                                        Mengikuti
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('users.follow', $post->user) }}" method="POST" class="follow-form">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-full text-xs font-semibold transition-colors">
                                        Ikuti
                                    </button>
                                </form>
                            @endif
                        @endif
                        
                        <button class="text-gray-400 hover:text-gray-600 dark:hover:text-white">•••</button>
                    </div>
                    
                    {{-- Isi Post (Judul & Caption) --}}
                    <a href="{{ route('posts.show', $post) }}" class="block mb-3 text-sm leading-relaxed text-gray-800 dark:text-gray-300 transition-colors duration-300">
                        <span class="font-bold block mb-1 text-base text-gray-900 dark:text-white">{!! $post->title !!}</span>
                        {!! $post->caption !!}
                    </a>

                    {{-- Gambar Post --}}
                    @if($post->image)
                    <div class="w-full aspect-[4/3] bg-gray-100 dark:bg-black rounded-xl flex items-center justify-center border border-gray-200 dark:border-white/10 mb-3 overflow-hidden relative">
                        @if(Str::startsWith($post->image, 'http'))
                            <img src="{{ $post->image }}" class="w-full h-full object-cover" alt="Post Image">
                        @else
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover" alt="Post Image">
                        @endif
                    </div>
                    @endif

                    {{-- Action Footer --}}
                    <div class="flex justify-between text-gray-500 dark:text-white/40 max-w-md pt-1">
                        {{-- Like Button --}}
                        @auth
                            <form action="{{ $post->hasLiked(Auth::user()) ? route('posts.unlike', $post) : route('posts.like', $post) }}" method="POST" class="like-form">
                                @csrf
                                @if($post->hasLiked(Auth::user()))
                                    @method('DELETE')
                                @endif
                                <button type="submit" class="flex items-center gap-2 {{ $post->hasLiked(Auth::user()) ? 'text-red-500' : 'hover:text-red-500' }} transition-colors group">
                                    <svg class="w-5 h-5" fill="{{ $post->hasLiked(Auth::user()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    <span class="text-xs">{{ $post->likes_count }}</span>
                                </button>
                            </form>
                        @endauth

                        {{-- Repo Link --}}
                        @if($post->github_link)
                        <a href="{{ $post->github_link }}" target="_blank" class="flex items-center gap-2 hover:text-blue-600 dark:hover:text-white transition-colors group">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                            <span class="text-xs">Repo</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </article>
        @endforeach

        
        @else
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="w-16 h-16 bg-gray-200 dark:bg-white/10 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-500 dark:text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-gray-900 dark:text-white font-bold text-lg">Belum ada karya</h3>
            <p class="text-gray-600 dark:text-white/40 text-sm mt-2">Jadilah yang pertama memamerkan karyamu!</p>
        </div>
        @endif

    </div>

    {{-- SCRIPT TYPEWRITER EFFECT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('typewriter-text');
            if(input) {
                const text = input.getAttribute('data-text');
                let i = 0;
                let isDeleting = false;
                let wait = 3000; // Waktu tunggu setelah selesai ngetik (ms)
                let speed = 100; // Kecepatan ngetik

                function type() {
                    // Atur kecepatan: Lebih cepat saat menghapus
                    speed = isDeleting ? 50 : 100;
                    
                    // Logika ketik vs hapus
                    if (!isDeleting && i <= text.length) {
                        input.value = text.substring(0, i++);
                    } else if (isDeleting && i >= 0) {
                        input.value = text.substring(0, i--);
                    }

                    // Logika pergantian fase
                    if (!isDeleting && i === text.length + 1) {
                        isDeleting = true;
                        speed = wait; // Diam dulu sebelum menghapus
                    } else if (isDeleting && i === -1) {
                        isDeleting = false;
                        i = 0;
                        speed = 500; // Diam dulu sebelum ngetik ulang
                    }

                    setTimeout(type, speed);
                }

                type();
            }
        });
    </script>
</x-app-layout>