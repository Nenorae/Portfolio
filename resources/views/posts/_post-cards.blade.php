@foreach($posts as $post)
    <div class="break-inside-avoid-column mb-4 post-item">
        <div class="group relative bg-white dark:bg-[#121212] border border-gray-200 dark:border-white/10 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
            
            {{-- Gambar --}}
            <a href="{{ route('posts.show', $post) }}">
                <div class="overflow-hidden relative"> 
                    @if (Str::startsWith($post->image, 'http'))
                        <img src="{{ $post->image }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    @else
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    @endif
                </div>
            </a>

            {{-- Konten Text --}}
            <div class="p-3 flex flex-col"> 
                
                {{-- Judul --}}
                <h3 class="text-lg font-bold text-gray-900 dark:text-white line-clamp-2 transition-colors duration-300">
                    {{ $post->title }}
                </h3>
                
                {{-- Deskripsi --}}
                <p class="text-gray-700 dark:text-gray-400 text-xs mt-1 line-clamp-3 mb-2 transition-colors duration-300">
                    {{ $post->caption }}
                </p>

                {{-- Footer Card --}}
                <div class="flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-800">
                    
                    {{-- User Info (Kiri) --}}
                    <div class="flex items-center gap-2">
                        {{-- Avatar Dinamis --}}
                        <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden flex-shrink-0">
                            @if($post->user->profile_photo)
                                <img src="{{ asset('storage/' . $post->user->profile_photo) }}" 
                                     alt="{{ $post->user->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random" 
                                     alt="{{ $post->user->name }}" 
                                     class="w-full h-full object-cover">
                            @endif
                        </div>

                        <p class="text-xs font-semibold text-gray-800 dark:text-gray-300">
                            {{ $post->user->name }}
                        </p>
                    </div>
                    
                    {{-- Tombol Aksi (Kanan) --}}
                    <div class="flex items-center gap-3">
                        
                        {{-- Tombol Like --}}
                        <button class="flex items-center gap-1 text-gray-600 dark:text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="text-xs">{{ $post->likes_count ?? 0 }}</span>
                        </button>

                        {{-- LOGIKA TOMBOL EDIT & DELETE (Hanya Untuk Pemilik) --}}
                        @if(Auth::id() === $post->user_id)
                            
                            {{-- Tombol Edit --}}
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-gray-500 hover:text-blue-500 transition-colors" title="Edit Post">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>

                            {{-- Tombol Delete (Form) --}}
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus karya ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-500 transition-colors" title="Hapus Post">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach