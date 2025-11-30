<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-white">

        <header class="flex flex-col md:flex-row items-center md:items-start gap-8 md:gap-16 mb-12">

            <div class="flex-shrink-0">
                <div class="w-24 h-24 md:w-40 md:h-40 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 p-[2px]">
                    <div class="w-full h-full rounded-full bg-black p-1">
                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random&size=200"
                            class="w-full h-full rounded-full object-cover border border-[#262626]">
                    </div>
                </div>
            </div>

            <div class="flex-1 w-full md:w-auto">

                <div class="flex flex-col md:flex-row items-center gap-4 mb-6">
                    <h2 class="text-xl md:text-2xl font-normal">{{ $user->username }}</h2>

                    @if(Auth::id() === $user->id)
                    <div class="flex gap-2">
                        <a href="{{ route('profile.edit') }}" class="bg-[#363636] hover:bg-[#262626] px-4 py-1.5 rounded-lg text-sm font-bold transition-colors">Edit Profil</a>
                        <button class="bg-[#363636] hover:bg-[#262626] px-4 py-1.5 rounded-lg text-sm font-bold transition-colors">Arsip</button>
                    </div>
                    <button class="text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg></button>
                    @else
                    <div class="flex gap-2">
                        <button class="bg-blue-600 hover:bg-blue-700 px-6 py-1.5 rounded-lg text-sm font-bold transition-colors">Connect</button> <button class="bg-[#363636] hover:bg-[#262626] px-4 py-1.5 rounded-lg text-sm font-bold transition-colors">Message</button>
                    </div>
                    @endif
                </div>

                <div class="hidden md:flex gap-10 mb-6 text-base">
                    <div><span class="font-bold text-white">{{ $postsCount }}</span> projects</div>
                    <div><span class="font-bold text-white">{{ $followersCount }}</span> connections</div>
                    <div><span class="font-bold text-white">{{ $followingCount }}</span> following</div>
                </div>

                <div class="text-sm md:text-base px-4 md:px-0 text-center md:text-left">
                    <h1 class="font-bold text-lg mb-1">{{ $user->name }}</h1>

                    <p class="whitespace-pre-line text-gray-300 mb-3 leading-relaxed">Mahasiswa Teknologi Rekayasa Internet PENS '24 🎓
                        Passionate about IoT & Web Development 💻
                        Open for collaboration 🚀</p>

                    @if(isset($skills) && $skills->count() > 0)
                    <div class="flex flex-wrap justify-center md:justify-start gap-2 mb-4">
                        @foreach($skills as $skill)
                        <span class="px-2.5 py-0.5 rounded text-xs font-semibold bg-[#262626] border border-[#363636] text-blue-400 hover:border-blue-500 transition-colors cursor-default">
                            {{ $skill }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    @if($user->website || $user->id)
                    <a href="#" class="text-[#E0F1FF] font-bold hover:underline flex items-center justify-center md:justify-start gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-4.155z" />
                        </svg>
                        linkedin.com/in/{{ $user->username }}
                    </a>
                    @endif
                </div>
            </div>
        </header>

        <div class="mb-12 overflow-x-auto no-scrollbar px-4 md:px-0">
            <div class="flex gap-6 md:gap-10 min-w-max">
                @foreach(['Best Of', 'IoT', 'Web', 'Events'] as $highlight)
                <div class="flex flex-col items-center gap-2 cursor-pointer group">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-[#121212] border-2 border-[#363636] flex items-center justify-center group-hover:border-white transition-colors">
                        @if($highlight == 'IoT')
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                        @elseif($highlight == 'Web')
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                        @else
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        @endif
                    </div>
                    <span class="text-xs font-medium">{{ $highlight }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex border-t border-[#262626] py-4 md:hidden justify-around text-sm text-gray-400 mb-4">
            <div class="text-center"><span class="block font-bold text-white">{{ $postsCount }}</span> projects</div>
            <div class="text-center"><span class="block font-bold text-white">{{ $followersCount }}</span> connect</div>
            <div class="text-center"><span class="block font-bold text-white">{{ $followingCount }}</span> following</div>
        </div>

        <div class="border-t border-[#262626] mb-4">
            <div class="flex justify-center gap-12 text-xs font-bold tracking-widest uppercase">
                <button class="border-t border-white py-4 flex items-center gap-2 text-white">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <path d="M3 9h18M9 21V9" />
                    </svg>
                    Portfolio
                </button>
                <button class="border-t border-transparent py-4 flex items-center gap-2 text-gray-500 hover:text-white transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    About
                </button>
            </div>
        </div>

        @if($posts->count() > 0)
        <div class="grid grid-cols-3 gap-1 md:gap-8">
            @foreach($posts as $post)
            <div class="group relative aspect-square bg-[#262626] cursor-pointer overflow-hidden rounded-sm md:rounded-lg">

                @if($post->image)
                @if(Str::startsWith($post->image, 'http'))
                <img src="{{ $post->image }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @endif
                @else
                <div class="w-full h-full flex flex-col items-center justify-center bg-gray-800 p-4 text-center">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    <span class="text-xs text-gray-400 font-mono">{{ $post->title }}</span>
                </div>
                @endif

                <div class="absolute inset-0 bg-black/80 hidden group-hover:flex flex-col items-center justify-center text-center p-4 transition-all fade-in">

                    <h3 class="text-white font-bold text-sm md:text-lg mb-1 line-clamp-2">{{ $post->title }}</h3>

                    @if($post->category)
                    <span class="text-primary text-xs font-semibold mb-4 uppercase tracking-wider">{{ $post->category }}</span>
                    @endif

                    <div class="flex gap-4">
                        <div class="flex items-center gap-1 text-white/80">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                            <span class="font-bold">{{ $post->likes_count }}</span>
                        </div>

                        @if($post->github_link)
                        <a href="{{ $post->github_link }}" target="_blank" class="text-white hover:text-blue-400 transition-colors" title="View Source Code">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                        @endif

                        @if($post->demo_link)
                        <a href="{{ $post->demo_link }}" target="_blank" class="text-white hover:text-green-400 transition-colors" title="Live Demo">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-20">
            <div class="w-16 h-16 rounded-full border-2 border-white flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold">Belum ada Proyek</h3>
            <p class="text-sm text-gray-400 mt-2 mb-4">Upload karya terbaikmu untuk membangun portofolio.</p>
        </div>
        @endif

        <footer class="mt-12 mb-8 text-xs text-gray-500 text-center space-y-4">
            <div>© 2025 MAHAKARYA</div>
        </footer>

    </div>
</x-app-layout>