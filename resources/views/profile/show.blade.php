<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-white">

        {{-- Profile Header --}}
        <div class="bg-[#121212] border border-[#262626] rounded-xl shadow-lg p-6 md:p-8 mb-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                {{-- Avatar --}}
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden border-2 border-[#262626] flex-shrink-0">
                    @if($user->profile_photo && $user->profile_photo !== 'default.jpg')
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->username }}'s profile photo" class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" alt="{{ $user->username }}'s profile photo" class="w-full h-full object-cover">
                    @endif
                </div>

                {{-- Profile Info --}}
                <div class="flex-1 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-4">
                        <h1 class="text-xl font-bold">{{ $user->username }}</h1>
                        {{-- Action Buttons --}}
                        @auth
                            @if(Auth::id() === $user->id)
                                <a href="{{ route('profile.edit') }}" class="bg-[#262626] hover:bg-[#363636] text-white font-bold py-2 px-4 rounded-lg transition-colors text-sm">
                                    Edit Profile
                                </a>
                            @else
                                {{-- Follow/Unfollow Button --}}
                                @if(Auth::user()->isFollowing($user))
                                    <form action="{{ route('users.unfollow', $user) }}" method="POST" class="follow-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors text-sm">
                                            Mengikuti
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('users.follow', $user) }}" method="POST" class="follow-form">
                                        @csrf
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors text-sm">
                                            Ikuti
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                    </div>

                    {{-- Stats --}}
                    <div class="flex justify-center md:justify-start gap-6 my-4 text-sm">
                        <div>
                            <span class="font-bold">{{ $postsCount }}</span>
                            <span class="text-gray-400">posts</span>
                        </div>
                        <div>
                            <span class="font-bold">{{ $followersCount }}</span>
                            <span class="text-gray-400">followers</span>
                        </div>
                        <div>
                            <span class="font-bold">{{ $followingCount }}</span>
                            <span class="text-gray-400">following</span>
                        </div>
                    </div>

                    <h2 class="font-semibold">{{ $user->name }}</h2>
                    <p class="text-gray-400 text-sm mt-1">{{ $user->bio }}</p>
                    @if($user->website)
                        <a href="{{ $user->website }}" target="_blank" rel="noopener noreferrer" class="text-blue-400 hover:underline text-sm mt-1 block">
                            {{ $user->website }}
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Posts Grid --}}
        <div class="border-t border-[#262626] pt-4">
             <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($posts as $post)
                    <a href="{{ route('posts.show', $post) }}" class="relative group aspect-square">
                        <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover rounded-md">
                        {{-- Overlay on hover --}}
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-md">
                            <div class="text-white text-center">
                                <p class="font-bold">{{ $post->title }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                    <span>{{ $post->likes_count }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-2 md:col-span-3 text-center py-16">
                        <h2 class="text-xl font-semibold">No posts yet</h2>
                        @if(Auth::check() && Auth::id() === $user->id)
                            <p class="text-gray-400 mt-2">Upload your first creation to showcase your portfolio.</p>
                            {{-- Add a link to the upload page if you have one --}}
                            {{-- <a href="#" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Upload Now</a> --}}
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('submit', function(e) {
            if (e.target.matches('.follow-form')) {
                e.preventDefault();
                const form = e.target;
                const action = form.action;
                const method = form.querySelector('input[name="_method"]')?.value || form.method;
                const csrfToken = form.querySelector('input[name="_token"]').value;

                fetch(action, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    const button = form.querySelector('button');

                    if (data.following) {
                        button.textContent = 'Mengikuti';
                        button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                        button.classList.add('bg-gray-600', 'hover:bg-gray-700');
                        if (!form.querySelector('input[name="_method"]')) {
                            const methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            methodInput.value = 'DELETE';
                            form.appendChild(methodInput);
                        }
                    } else {
                        button.textContent = 'Ikuti';
                        button.classList.remove('bg-gray-600', 'hover:bg-gray-700');
                        button.classList.add('bg-blue-600', 'hover:bg-blue-700');
                        if (form.querySelector('input[name="_method"]')) {
                            form.querySelector('input[name="_method"]').remove();
                        }
                    }
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
            }
        });
    });
    </script>
    @endpush
</x-app-layout>
