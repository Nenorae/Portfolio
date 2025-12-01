<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 transition-colors duration-300">

        {{-- Header Nav --}}
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('profile.show', ['username' => Auth::user()->username]) }}" class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-800 text-gray-500 dark:text-gray-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pengaturan Profil</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kelola informasi pribadi dan keamanan akunmu.</p>
            </div>
        </div>

        {{-- ALERT NOTIFIKASI --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
                <i class="bi bi-check-circle-fill text-xl"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KOLOM KIRI: MENU & FOTO (Sticky) --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-[#121212] border border-gray-200 dark:border-[#262626] rounded-2xl shadow-sm overflow-hidden sticky top-24">
                    
                    {{-- Banner Hiasan --}}
                    <div class="h-24 bg-gradient-to-r from-blue-500 to-purple-600"></div>

                    <div class="px-6 pb-6 text-center -mt-12">
                        {{-- FORM FOTO PROFIL --}}
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="relative inline-block group">
                            @csrf
                            @method('patch')
                            
                            {{-- TRIK INPUT SILUMAN --}}
                            <input type="hidden" name="name" value="{{ $user->name }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">

                            <div class="w-24 h-24 rounded-full border-4 border-white dark:border-[#121212] overflow-hidden bg-gray-200 dark:bg-gray-800 shadow-md">
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" class="w-full h-full object-cover">
                                @endif
                            </div>

                            {{-- Tombol Upload Overlay --}}
                            <label class="absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full shadow-lg cursor-pointer transition-transform hover:scale-110 border-2 border-white dark:border-[#121212]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <input type="file" name="avatar" class="hidden" onchange="this.form.submit()">
                            </label>
                        </form>
                        
                        <h2 class="mt-3 text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ '@' . $user->username }}</p>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: FORM EDIT --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- 1. KARTU INFORMASI DASAR --}}
                <div class="bg-white dark:bg-[#121212] border border-gray-200 dark:border-[#262626] rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Informasi Dasar</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Perbarui biodata dan informasi publik profilmu.</p>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Nama Lengkap --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full bg-gray-50 dark:bg-[#1a1a1a] border border-gray-300 dark:border-[#333] text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Username --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Username</label>
                                <input type="text" value="{{ $user->username }}" disabled
                                    class="w-full bg-gray-100 dark:bg-[#1a1a1a]/50 border border-gray-200 dark:border-[#333] text-gray-500 rounded-xl px-4 py-3 cursor-not-allowed">
                            </div>
                        </div>

                        {{-- Bio --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Bio</label>
                            <textarea name="bio" rows="3"
                                class="w-full bg-gray-50 dark:bg-[#1a1a1a] border border-gray-300 dark:border-[#333] text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                                placeholder="Ceritakan sedikit tentang dirimu...">{{ old('bio', $user->bio) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Email --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full bg-gray-50 dark:bg-[#1a1a1a] border border-gray-300 dark:border-[#333] text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Website --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Website</label>
                                <input type="url" name="website" value="{{ old('website', $user->website) }}"
                                    class="w-full bg-gray-50 dark:bg-[#1a1a1a] border border-gray-300 dark:border-[#333] text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="https://...">
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-1">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- 2. KARTU KEAHLIAN / SKILLS (POSISI BARU: DIATAS KEAMANAN) --}}
                <div class="bg-white dark:bg-[#121212] border border-gray-200 dark:border-[#262626] rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Keahlian / Skills</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Tambahkan keahlianmu agar profilmu lebih menarik (contoh: PHP, Public Speaking).</p>
                    
                    {{-- FORM SKILLS LANGSUNG DISINI (INLINE) BIAR GAK DUPLIKAT HEADER --}}
                    <form method="post" action="{{ route('skills.store') }}" class="mt-0">
                        @csrf
                        
                        <div class="flex gap-3">
                            <div class="flex-1">
                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="Ketik skill lalu Enter..." 
                                    required
                                    class="w-full bg-gray-50 dark:bg-[#1a1a1a] border border-gray-300 dark:border-[#333] text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                >
                            </div>
                            <button type="submit" class="bg-gray-900 dark:bg-white text-white dark:text-black font-bold py-3 px-6 rounded-xl hover:opacity-90 transition-opacity">
                                {{ __('Tambah') }}
                            </button>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </form>

                    {{-- List Skill (Chips) --}}
                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach(Auth::user()->skills as $skill)
                            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-800 transition-colors">
                                <span>{{ $skill->name }}</span>
                                
                                <form action="{{ route('skills.destroy', $skill) }}" method="POST" class="ml-2 flex items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-blue-400 hover:text-red-500 dark:text-blue-400 dark:hover:text-red-400 transition-colors focus:outline-none" title="Hapus">
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
                </div>

                {{-- 3. KARTU KEAMANAN (Password) --}}
                <div class="bg-white dark:bg-[#121212] border border-gray-200 dark:border-[#262626] rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Keamanan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Perbarui kata sandi akun Anda.</p>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Password Saat Ini</label>
                            <input name="current_password" type="password"
                                class="w-full bg-gray-50 dark:bg-[#1a1a1a] border border-gray-300 dark:border-[#333] text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Password Baru</label>
                                <input name="password" type="password"
                                    class="w-full bg-gray-50 dark:bg-[#1a1a1a] border border-gray-300 dark:border-[#333] text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">Konfirmasi Password</label>
                                <input name="password_confirmation" type="password"
                                    class="w-full bg-gray-50 dark:bg-[#1a1a1a] border border-gray-300 dark:border-[#333] text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" class="bg-gray-900 dark:bg-white text-white dark:text-black font-bold py-3 px-6 rounded-full hover:opacity-90 transition-opacity">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- 4. KARTU BAHAYA (Hapus Akun) --}}
                <div class="bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/30 rounded-2xl p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-red-600 dark:text-red-400">Zona Berbahaya</h3>
                            <p class="text-sm text-red-500/70 dark:text-red-400/70">Hapus akun dan semua data secara permanen.</p>
                        </div>
                        <button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-5 rounded-lg text-sm transition-colors shadow-sm"
                        >Hapus Akun</button>
                    </div>

                    {{-- Modal Konfirmasi Hapus --}}
                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white dark:bg-[#181818]">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Konfirmasi Hapus Akun</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Apakah Anda yakin? Tindakan ini tidak dapat dibatalkan.</p>

                            <div class="mt-6">
                                <label for="password_delete" class="sr-only">Password</label>
                                <input id="password_delete" name="password" type="password" placeholder="Masukkan Password Anda"
                                    class="w-full bg-gray-50 dark:bg-[#262626] border border-gray-300 dark:border-[#363636] text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500">
                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5 rounded-lg font-medium transition-colors">
                                    Batal
                                </button>
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-5 rounded-lg transition-colors">
                                    Ya, Hapus Akun
                                </button>
                            </div>
                        </form>
                    </x-modal>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>