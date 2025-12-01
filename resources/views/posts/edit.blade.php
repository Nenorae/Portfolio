<x-app-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-gray-100 dark:bg-black transition-colors duration-300">
        
        <div class="w-full max-w-3xl bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-800 rounded-3xl shadow-xl overflow-hidden transition-colors duration-300">
            
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12">
                @csrf
                @method('PUT') {{-- Wajib untuk update --}}

                <div class="flex justify-between items-center mb-8 border-b border-gray-200 dark:border-gray-800 pb-4">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Karya</h2>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition-colors text-sm">
                        Update
                    </button>
                </div>

                {{-- Preview Gambar Lama --}}
                <div class="mb-8">
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-400 uppercase mb-2">Gambar Saat Ini</label>
                    <div class="relative h-48 w-full rounded-xl overflow-hidden border border-gray-300 dark:border-gray-700">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover opacity-70">
                        <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                            <p class="text-white text-sm font-medium">Upload gambar baru untuk mengganti</p>
                        </div>
                    </div>
                    <input type="file" name="image" class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                {{-- Judul --}}
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-400 uppercase mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}"
                           class="w-full border-0 border-b border-gray-300 dark:border-gray-700 text-xl font-bold text-gray-900 dark:text-white py-2 bg-transparent focus:ring-0 focus:border-blue-500 transition-colors">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-400 uppercase mb-1">Deskripsi</label>
                    <textarea name="caption" rows="5" 
                              class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg p-4 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ old('caption', $post->caption) }}</textarea>
                </div>

                {{-- Links --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-400 uppercase mb-2">Github</label>
                        <input type="url" name="github_link" value="{{ old('github_link', $post->github_link) }}"
                               class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-3 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-400 uppercase mb-2">Demo</label>
                        <input type="url" name="demo_link" value="{{ old('demo_link', $post->demo_link) }}"
                               class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-3 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('posts.index') }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-white font-medium text-sm mr-4 mt-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>