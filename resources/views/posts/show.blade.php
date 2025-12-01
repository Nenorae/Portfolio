<x-app-layout>
    <div class="py-6 bg-gray-100 dark:bg-black min-h-screen transition-colors duration-300">
        <div class="max-w-6xl mx-auto px-4 lg:px-8">
            
            {{-- Navigation/Header --}}
            <div class="mb-4">
                <a href="{{ route('posts.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-500 transition-colors duration-300 flex items-center gap-2 font-medium text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali ke Galeri
                </a>
            </div>

            {{-- MAIN CONTENT CARD --}}
            <div class="bg-white dark:bg-[#121212] border border-gray-300 dark:border-gray-800 rounded-xl shadow-xl overflow-hidden flex flex-col lg:flex-row transition-colors duration-300">
                
                {{-- KOLOM KIRI: VISUAL & KONTEN (Major Content) --}}
                <div class="lg:w-3/4 p-6 lg:p-10 border-r border-gray-200 dark:border-gray-800">
                    
                    {{-- Judul --}}
                    <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">
                        {{ $post->title }}
                    </h1>
                    
                    {{-- Image Display --}}
                    @if ($post->image)
                        <div class="mb-6 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 shadow-md">
                            <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" 
                                 alt="Post Image" 
                                 class="w-full object-cover">
                        </div>
                    @endif

                    {{-- Deskripsi/Caption --}}
                    <div class="text-gray-800 dark:text-gray-300 text-lg leading-relaxed whitespace-pre-wrap">
                        {{ $post->caption }}
                    </div>

                    {{-- Like/Action Bar --}}
                    <div class="pt-6 mt-6 border-t border-gray-200 dark:border-gray-700">
                        <button class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-red-500 transition-colors group">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            <span class="text-sm">0 Likes</span> {{-- Placeholder for dynamic like count --}}
                        </button>
                    </div>

                </div>

                {{-- KOLOM KANAN: METADATA & CTA (Sidebar Detail) --}}
                <div class="lg:w-1/4 p-6 lg:p-8 bg-gray-50 dark:bg-[#1a1a1a]">
                    
                    {{-- User Info --}}
                    <a href="{{ route('profile.show', $post->user->username) }}" class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-4 mb-4 hover:bg-gray-100 dark:hover:bg-gray-800 p-2 -m-2 rounded transition-colors duration-300">
                        <div class="w-10 h-10 rounded-full bg-yellow-600 flex-shrink-0"></div>
                        <div>
                            <p class="font-bold text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $post->user->username }}</p>
                        </div>
                    </a>

                    {{-- Proyek Links --}}
                    <h3 class="font-bold text-gray-800 dark:text-white mb-3 mt-5">Informasi Proyek</h3>
                    <div class="space-y-3 text-sm">
                        
                        {{-- GitHub Link --}}
                        @if ($post->github_link)
                            <a href="{{ $post->github_link }}" target="_blank" class="flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:underline">
                                <i class="bi bi-github w-5 h-5"></i> <span>Repository Code</span>
                            </a>
                        @endif

                        {{-- Demo Link --}}
                        @if ($post->demo_link)
                            <a href="{{ $post->demo_link }}" target="_blank" class="flex items-center gap-2 text-green-600 dark:text-green-400 hover:underline">
                                <i class="bi bi-box-arrow-up-right w-5 h-5"></i> <span>Live Demo</span>
                            </a>
                        @endif

                        {{-- Tanggal Posting --}}
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400 pt-3 border-t border-gray-200 dark:border-gray-700">
                            <i class="bi bi-calendar w-5 h-5"></i> 
                            <span>Diposting: {{ $post->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    
                    {{-- Share Section --}}
                    <div class="pt-6 mt-6 border-t border-gray-200 dark:border-gray-700">
                        <p class="font-bold text-gray-800 dark:text-white mb-2">Bagikan Karya Ini</p>
                        <div class="flex gap-3 text-gray-600 dark:text-gray-400">
                            <button class="hover:text-blue-500"><i class="bi bi-whatsapp w-6 h-6"></i></button>
                            <button class="hover:text-blue-500"><i class="bi bi-twitter-x w-6 h-6"></i></button>
                            <button class="hover:text-blue-500"><i class="bi bi-link-45deg w-6 h-6"></i></button>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>