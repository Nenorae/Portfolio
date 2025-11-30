<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-white">

        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('profile.show', ['username' => Auth::user()->username]) }}" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h1 class="text-2xl font-bold">Edit Profil</h1>
        </div>

        <div class="bg-[#121212] border border-[#262626] rounded-xl overflow-hidden shadow-lg">

            {{-- UPDATE PROFILE INFORMATION --}}
            <div class="p-6 md:p-8 border-b border-[#262626]">
                @if (session('success'))
                    <div class="mb-6 bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        {{ session('success') }}
                    </div>
                @endif
                 @if (session('status') === 'profile-updated')
                    <div class="mb-6 bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded-lg text-sm">
                        Informasi profil berhasil disimpan.
                    </div>
                @endif


                <div class="flex flex-col md:flex-row items-center gap-8 mb-8">
                    <div class="relative group">
                        <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden border-2 border-[#262626]">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h2 class="text-lg font-bold">{{ $user->username }}</h2>
                        <p class="text-gray-400 text-sm mb-4">{{ $user->name }}</p>
                        <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="bg-[#262626] hover:bg-[#363636] text-blue-400 font-bold py-2 px-4 rounded-lg cursor-pointer transition-colors text-sm inline-block">
                                Ubah Foto Profil
                                <input type="file" name="avatar" class="hidden" onchange="this.form.submit()">
                            </label>
                            @error('avatar')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                        </form>
                    </div>
                </div>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6 max-w-xl">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full bg-[#262626] border border-[#363636] text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Username</label>
                        <input type="text" value="{{ $user->username }}" disabled
                            class="w-full bg-[#1a1a1a] border border-[#363636] text-gray-500 rounded-lg p-2.5 cursor-not-allowed">
                        <p class="text-xs text-gray-600 mt-1">Username tidak dapat diubah.</p>
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-400 mb-2">Bio</label>
                        <textarea id="bio" name="bio" rows="4"
                            class="w-full bg-[#262626] border border-[#363636] text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            placeholder="Ceritakan sedikit tentang dirimu...">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-400 mb-2">Website</label>
                        <input id="website" type="url" name="website" value="{{ old('website', $user->website) }}"
                            class="w-full bg-[#262626] border border-[#363636] text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            placeholder="https://yourwebsite.com">
                    </div>
                     <div>
                        <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full bg-[#262626] border border-[#363636] text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- UPDATE PASSWORD --}}
            <div class="p-6 md:p-8 border-b border-[#262626]">
                <section>
                    <header class="mb-6">
                        <h2 class="text-lg font-medium text-white">Ubah Kata Sandi</h2>
                        <p class="mt-1 text-sm text-gray-400">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                    </header>
                    @if (session('status') === 'password-updated')
                        <div class="mb-6 bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded-lg text-sm">
                            Kata sandi berhasil disimpan.
                        </div>
                    @endif

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6 max-w-xl">
                        @csrf
                        @method('put')

                        <div>
                            <label for="update_password_current_password" class="block text-sm font-medium text-gray-400 mb-2">Kata Sandi Saat Ini</label>
                            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                                class="w-full bg-[#262626] border border-[#363636] text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="update_password_password" class="block text-sm font-medium text-gray-400 mb-2">Kata Sandi Baru</label>
                            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                                class="w-full bg-[#262626] border border-[#363636] text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-400 mb-2">Konfirmasi Kata Sandi</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                                class="w-full bg-[#262626] border border-[#363636] text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center transition-colors">
                                Simpan
                            </button>
                        </div>
                    </form>
                </section>
            </div>

            {{-- DELETE ACCOUNT --}}
            <div class="p-6 md:p-8">
                <section class="space-y-6">
                    <header>
                        <h2 class="text-lg font-medium text-white">Hapus Akun</h2>
                        <p class="mt-1 text-sm text-gray-400">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
                    </header>

                    <button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5"
                    >Hapus Akun</button>

                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-[#181818] border border-[#262626] rounded-lg">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-white">Apakah Anda yakin ingin menghapus akun Anda?</h2>
                            <p class="mt-1 text-sm text-gray-400">Masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.</p>

                            <div class="mt-6">
                                <label for="password_delete" class="sr-only">Password</label>
                                <input id="password_delete" name="password" type="password" placeholder="Password"
                                    class="w-3/4 bg-[#262626] border border-[#363636] text-white rounded-lg focus:ring-red-500 focus:border-red-500 p-2.5">
                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="button" x-on:click="$dispatch('close')" class="text-gray-300 bg-transparent hover:bg-gray-700/50 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Batal
                                </button>
                                <button type="submit" class="ms-3 text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Hapus Akun
                                </button>
                            </div>
                        </form>
                    </x-modal>
                </section>
            </div>

        </div>
    </div>
</x-app-layout>
