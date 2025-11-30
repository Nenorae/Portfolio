<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="p-4 border-b border-[#262626] hidden md:block mb-4">
        <div class="flex gap-4">
            <div class="w-10 h-10 rounded-full bg-gray-700 overflow-hidden flex-shrink-0">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
                <input type="text" placeholder="Apa yang sedang kamu kerjakan, {{ Auth::user()->name }}?" class="w-full bg-transparent border-none text-white placeholder-white/40 focus:ring-0 text-lg mb-4">
                <div class="flex justify-between items-center">
                    <div class="flex gap-2 text-primary">
                        <button class="p-2 hover:bg-white/10 rounded-full transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                    <button class="bg-primary text-white px-6 py-2 rounded-full font-bold text-sm hover:opacity-90 transition-opacity">Posting</button>
                </div>
            </div>
        </div>
    </div>

    <div class="divide-y divide-[#262626]">

        @if($posts->count() > 0)

        @foreach($posts as $post)
        <article class="p-4 hover:bg-white/[0.02] transition-colors cursor-pointer">
            <div class="flex gap-3">

                <div class="w-10 h-10 rounded-full bg-gray-700 flex-shrink-0 overflow-hidden border border-gray-600">
                    <img src="https://ui-avatars.com/api/?name={{ $post->user->name }}&background=random" class="w-full h-full object-cover">
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex items-center gap-2 truncate">
                            <span class="font-bold truncate text-white">{{ $post->user->name }}</span>
                            <span class="text-white/40 text-sm">{{ '@'.strtolower(str_replace(' ', '', $post->user->name)) }}</span>
                            <span class="text-white/40 text-sm">• {{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <button class="text-white/40 hover:text-white">•••</button>
                    </div>

                    <p class="mb-3 text-sm leading-relaxed text-white">
                        <span class="font-bold block mb-1 text-base">{{ $post->title }}</span>
                        {{ $post->caption }}
                    </p>

                    @if($post->image)
                    <div class="w-full aspect-[4/3] bg-black rounded-xl flex items-center justify-center border border-white/10 mb-3 overflow-hidden relative">
                        @if(Str::startsWith($post->image, 'http'))
                        <img src="{{ $post->image }}" class="w-full h-full object-cover" alt="Post Image">
                        @else
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover" alt="Post Image">
                        @endif
                    </div>
                    @endif

                    <div class="flex justify-between text-white/40 max-w-md">
                        <button class="flex items-center gap-2 hover:text-primary transition-colors group">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span class="text-xs">{{ $post->likes_count }}</span>
                        </button>
                        @if($post->github_link)
                        <a href="{{ $post->github_link }}" target="_blank" class="flex items-center gap-2 hover:text-white transition-colors group">
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
            <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-white font-bold text-lg">Belum ada karya</h3>
            <p class="text-white/40 text-sm mt-2">Jadilah yang pertama memamerkan karyamu!</p>
        </div>
        @endif

    </div>
</x-app-layout>