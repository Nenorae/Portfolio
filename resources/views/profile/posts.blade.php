<x-app-layout>
    <x-slot name="header"></x-slot>

    <!-- HERO SECTION WITH GRADIENT -->
    <div class="relative bg-gradient-to-br from-gray-900 via-black to-gray-900 pb-20">
        <!-- BACK BUTTON -->
        <div class="max-w-7xl mx-auto px-6 pt-8">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="text-sm font-medium">Kembali</span>
            </a>
        </div>

        <!-- TITLE & META -->
        <div class="max-w-7xl mx-auto px-6 mt-12">
            <div class="max-w-4xl">
                @if($post->category)
                <span class="inline-flex items-center gap-2 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-semibold px-4 py-2 rounded-full uppercase tracking-wider backdrop-blur-sm">
                    <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                    {{ $post->category }}
                </span>
                @endif

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mt-6 leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-6 mt-8 text-sm text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $post->created_at->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="max-w-7xl mx-auto px-6 -mt-10 pb-20">
        <div class="space-y-8">

            <!-- IMAGE AND ACTION BUTTONS ROW -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- MAIN IMAGE -->
                <div class="lg:col-span-2">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-3xl blur-2xl opacity-50 group-hover:opacity-75 transition-opacity"></div>
                        <div class="relative bg-[#0a0a0a] border border-gray-800/50 rounded-3xl overflow-hidden shadow-2xl">
                            @if($post->image)
                            @if(Str::startsWith($post->image, 'http'))
                            <img src="{{ $post->image }}" class="w-full h-auto object-cover" alt="{{ $post->title }}">
                            @else
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-auto object-cover" alt="{{ $post->title }}">
                            @endif
                            @else
                            <div class="aspect-video w-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                <div class="text-center space-y-4">
                                    <svg class="w-16 h-16 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-500 text-sm font-medium">No Preview Image</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- ACTION BUTTONS SIDEBAR -->
                <div class="space-y-6 relative z-20"> <!-- Added z-20 to ensure buttons stay on top -->
                    <!-- ACTION BUTTONS -->
                    <div class="space-y-3 sticky top-24"> <!-- Added sticky positioning -->
                        @if($post->demo_link)
                        <a href="{{ $post->demo_link }}" target="_blank" class="group relative block">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl blur opacity-50 group-hover:opacity-75 transition-opacity"></div>
                            <div class="relative flex items-center justify-center gap-3 w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg z-10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Live Demo
                            </div>
                        </a>
                        @endif

                        @if($post->github_link)
                        <a href="{{ $post->github_link }}" target="_blank" class="flex items-center justify-center gap-3 w-full bg-[#0a0a0a] hover:bg-gray-900 border border-gray-800 hover:border-gray-700 text-white font-bold py-4 px-6 rounded-xl transition-all relative z-10">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            Source Code
                        </a>
                        @endif
                    </div>

                    <!-- TAGS (Desktop) -->
                    @if($post->tags)
                    <div class="hidden lg:block bg-[#0a0a0a] border border-gray-800/50 rounded-3xl p-6 shadow-xl">
                        <h3 class="text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Tags
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $post->tags) as $tag)
                            <span class="px-4 py-2 bg-gradient-to-r from-gray-800 to-gray-900 border border-gray-700/50 rounded-full text-xs text-gray-300 font-medium hover:border-blue-500/50 transition-colors cursor-pointer">#{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- PROJECT DESCRIPTION (FULL WIDTH) -->
            <div class="bg-[#0a0a0a] border border-gray-800/50 rounded-3xl p-8 shadow-xl">
                <h2 class="text-white text-2xl font-bold flex items-center gap-3 mb-6">
                    <div class="p-2 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    Tentang Proyek
                </h2>
                <div class="prose prose-invert prose-lg max-w-none text-gray-300 leading-relaxed">
                    {!! nl2br(e($post->caption)) !!}
                </div>
            </div>

            <!-- TAGS SECTION (Mobile) -->
            @if($post->tags)
            <div class="lg:hidden bg-[#0a0a0a] border border-gray-800/50 rounded-3xl p-6 shadow-xl">
                <h3 class="text-white text-lg font-bold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Tags
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $post->tags) as $tag)
                    <span class="px-4 py-2 bg-gradient-to-r from-gray-800 to-gray-900 border border-gray-700/50 rounded-full text-xs text-gray-300 font-medium hover:border-blue-500/50 transition-colors">#{{ trim($tag) }}</span>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>