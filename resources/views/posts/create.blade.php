<x-app-layout>
    {{-- WRAPPER LUAR: Background Dinamis --}}
    <div class="min-h-screen flex items-center justify-center p-6 bg-gray-100 dark:bg-black transition-colors duration-300">
        
        {{-- CARD UTAMA: SATU KOLOM (Minimalis) --}}
        <div class="w-full max-w-3xl bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-800 rounded-3xl shadow-xl overflow-hidden transition-colors duration-300">
            
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12">
                @csrf

                {{-- Header Simpan --}}
                <div class="flex justify-end mb-8 border-b border-gray-200 dark:border-gray-800 pb-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition-colors text-sm">
                        Simpan Post
                    </button>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-300 rounded-xl text-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- 1. UPLOAD GAMBAR (Area di atas form) --}}
                <div class="mb-8">
                    <label for="image-upload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors relative" id="drop-area">
                        
                        <input id="image-upload" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" required />

                        <div class="text-center">
                            <svg class="w-8 h-8 text-gray-500 dark:text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-4-4V6a4 4 0 014-4h10a4 4 0 014 4v6a4 4 0 01-4 4h-3m-3-4l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-sm text-gray-700 dark:text-gray-400 font-medium">Pilih Gambar atau Seret di Sini (Max 2MB)</p>
                            <p id="image-name" class="text-xs text-blue-500 mt-1"></p>
                        </div>
                    </label>
                    <img id="preview-img" class="mt-4 w-full h-auto rounded-lg shadow-md hidden" />
                </div>

                {{-- 2. INPUT FIELDS --}}
                <div class="space-y-6">
                    
                    {{-- Judul --}}
                    <div>
                        <label for="title" class="block text-xs font-bold text-gray-700 dark:text-gray-400 uppercase mb-1">Judul Proyek</label>
                        <input type="text" name="title" id="title"
                               class="w-full border-0 border-b border-gray-300 dark:border-gray-700 text-xl font-bold text-gray-900 dark:text-white py-3 focus:border-blue-500 focus:ring-0 transition-colors bg-transparent placeholder-gray-400"
                               placeholder="Tambahkan judul yang ringkas" value="{{ old('title') }}" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="caption" class="block text-xs font-bold text-gray-700 dark:text-gray-400 uppercase mb-1">Deskripsi & Detail</label>
                        <textarea name="caption" id="caption" rows="5" 
                                  class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg p-4 text-gray-900 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                  placeholder="Jelaskan fitur, teknologi, atau konsep proyekmu..." required>{{ old('caption') }}</textarea>
                    </div>

                    {{-- Links (Single Column) --}}
                    <div class="space-y-4 pt-2">
                        <h4 class="font-semibold text-gray-900 dark:text-white">Tautan (Opsional)</h4>
                        
                        {{-- Github Link --}}
                        <div class="flex items-center gap-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-3">
                            <i class="bi bi-github text-lg text-gray-500"></i>
                            <input type="url" name="github_link" 
                                   class="w-full bg-transparent border-none p-0 text-gray-900 dark:text-white focus:ring-0 placeholder-gray-500"
                                   placeholder="Link Repository GitHub" value="{{ old('github_link') }}">
                        </div>
                        
                        {{-- Demo Link --}}
                        <div class="flex items-center gap-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-3">
                            <i class="bi bi-globe text-lg text-gray-500"></i>
                            <input type="url" name="demo_link" 
                                   class="w-full bg-transparent border-none p-0 text-gray-900 dark:text-white focus:ring-0 placeholder-gray-500"
                                   placeholder="Link Demo Aplikasi" value="{{ old('demo_link') }}">
                        </div>
                    </div>
                </div>

                {{-- Actions (Paling Bawah) --}}
                <div class="mt-8 flex justify-end">
                    <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-black dark:text-gray-400 dark:hover:text-white font-medium transition-colors text-sm mr-4 mt-2">Batal</a>
                    {{-- Simpan button sudah di atas --}}
                </div>
            </form>
        </div>
    </div>

    {{-- Script JS Preview --}}
    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview-img');
            const uploadLabel = document.getElementById('drop-area');
            const fileNameDisplay = document.getElementById('image-name');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    uploadLabel.classList.add('hidden'); // Sembunyikan area upload
                    fileNameDisplay.textContent = input.files[0].name; // Tampilkan nama file
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>