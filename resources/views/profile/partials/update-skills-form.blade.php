<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Keahlian / Skills') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Tambahkan keahlianmu agar profilmu lebih menarik (contoh: PHP, Public Speaking).') }}
        </p>
    </header>

    {{-- Form Input Skill --}}
    <form method="post" action="{{ route('skills.store') }}" class="mt-6 flex gap-2">
        @csrf
        <div class="flex-1">
            <input type="text" name="name" placeholder="Ketik skill lalu Enter..." required
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
        </div>
        <button type="submit" 
            class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            {{ __('Tambah') }}
        </button>
    </form>

    {{-- List Skill (Badges) --}}
    <div class="mt-6 flex flex-wrap gap-2">
        @foreach(Auth::user()->skills as $skill)
            <div class="flex items-center gap-2 px-4 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full border border-indigo-100 dark:border-indigo-800 text-sm font-medium transition-colors">
                <span>{{ $skill->name }}</span>
                
                <form action="{{ route('skills.destroy', $skill) }}" method="POST" class="inline-flex">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ml-1 text-indigo-400 hover:text-red-500 dark:text-indigo-400 dark:hover:text-red-400 transition-colors" title="Hapus Skill">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </form>
            </div>
        @endforeach
        
        @if(Auth::user()->skills->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-500 italic">Belum ada keahlian ditambahkan.</p>
        @endif
    </div>
</section>