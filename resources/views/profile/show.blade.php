<x-app-layout>
    <x-slot name="header"></x-slot>

    {{-- Wrapper utama --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-900 dark:text-white transition-colors duration-300">

        {{-- Profile Header Card --}}
        {{-- TAMBAHKAN CLASS 'relative' DI SINI --}}
        <div class="relative bg-white dark:bg-[#121212] border border-gray-300 dark:border-[#262626] rounded-xl shadow-lg p-6 md:p-8 mb-8 transition-colors duration-300">
            
            <div class="flex flex-col md:flex-row items-start gap-8">
                
                {{-- Avatar --}}
                <div class="flex-shrink-0 mx-auto md:mx-0">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden border-2 border-gray-300 dark:border-[#262626]">
                        @if($user->profile_photo && $user->profile_photo !== 'default.jpg')
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->username }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" alt="{{ $user->username }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                {{-- Profile Info --}}
                <div class="flex-1 min-w-0 w-full text-center md:text-left">
                    
                    {{-- 1. USERNAME + SKILLS --}}
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-4">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-none">
                            {{ $user->username }}
                        </h1>

                        @foreach($user->skills as $skill)
                            <span class="px-2.5 py-1 rounded-md bg-gray-100 dark:bg-[#262626] border border-gray-200 dark:border-[#404040] text-[11px] font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider shadow-sm flex items-center h-fit">
                                {{ $skill->name }}
                            </span>
                        @endforeach
                    </div>

                    {{-- 2. STATISTIK --}}
                    <div class="flex justify-center md:justify-start gap-6 mb-4 text-sm">
                        <div>
                            <span class="font-bold text-gray-900 dark:text-white text-lg">{{ $postsCount }}</span>
                            <span class="text-gray-500 dark:text-gray-400">posts</span>
                        </div>
                        <div>
                            <span class="font-bold text-gray-900 dark:text-white text-lg">{{ $followersCount }}</span>
                            <span class="text-gray-500 dark:text-gray-400">followers</span>
                        </div>
                        <div>
                            <span class="font-bold text-gray-900 dark:text-white text-lg">{{ $followingCount }}</span>
                            <span class="text-gray-500 dark:text-gray-400">following</span>
                        </div>
                    </div>

                    {{-- 3. NAMA ASLI & BIO --}}
                    <div class="mb-4 md:mb-0"> {{-- Tambah margin bawah di HP biar gak nempel tombol --}}
                        <h2 class="font-bold text-lg text-gray-900 dark:text-white">{{ $user->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mt-1 leading-relaxed whitespace-pre-line max-w-xl">{{ $user->bio }}</p>
                        
                        @if($user->website)
                            <a href="{{ $user->website }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 hover:underline text-sm mt-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                                {{ parse_url($user->website, PHP_URL_HOST) ?? $user->website }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 4. TOMBOL AKSI (POSISI: POJOK KANAN BAWAH) --}}
            {{-- md:absolute md:bottom-8 md:right-8 -> Ini kuncinya --}}
            <div class="flex items-center justify-center gap-3 mt-6 md:mt-0 md:absolute md:bottom-8 md:right-8">
                @auth
                    @if(Auth::id() === $user->id)
                        {{-- Edit Profile --}}
                        <a href="{{ route('profile.edit') }}" class="bg-gray-100 hover:bg-gray-200 dark:bg-[#262626] dark:hover:bg-[#363636] border border-gray-200 dark:border-[#404040] text-gray-800 dark:text-white font-bold py-2 px-5 rounded-lg transition-colors text-xs uppercase tracking-wider">
                            Edit Profil
                        </a>
                        
                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-50 hover:bg-red-100 dark:bg-red-900/10 dark:hover:bg-red-900/20 border border-red-100 dark:border-red-900/30 text-red-600 dark:text-red-400 font-bold py-2 px-5 rounded-lg transition-colors text-xs uppercase tracking-wider flex items-center gap-2">
                                Logout
                            </button>
                        </form>
                    @else
                        {{-- Follow/Unfollow --}}
                        @if(Auth::user()->isFollowing($user))
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-gray-200 dark:bg-[#333] text-gray-900 dark:text-white font-bold py-2 px-6 rounded-lg transition-colors text-sm">
                                    Mengikuti
                                </button>
                            </form>
                        @else
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-colors text-sm">
                                    Ikuti
                                </button>
                            </form>
                        @endif
                    @endif
                @endauth
            </div>

        </div>

        {{-- Posts Grid (Tetap Sama) --}}
        <div class="border-t border-gray-300 dark:border-[#262626] pt-8 transition-colors duration-300">
             <div class="grid grid-cols-2 md:grid-cols-3 gap-1 md:gap-4">
                @forelse($posts as $post)
                    <a href="{{ route('posts.show', $post) }}" class="relative group aspect-square overflow-hidden bg-gray-100 dark:bg-[#262626]">
                        @if(Str::startsWith($post->image, 'http'))
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @endif
                        
                        {{-- Overlay Hover --}}
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <div class="flex items-center gap-2 font-bold text-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    <span>{{ $post->likes_count }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-2 md:col-span-3 flex flex-col items-center justify-center py-20">
                        <div class="w-16 h-16 bg-gray-200 dark:bg-[#262626] rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Belum ada karya</h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Upload karya pertamamu sekarang!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script Follow/Unfollow
    });
    </script>
    @endpush
</x-app-layout>