@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Profile Card --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <div class="flex items-center gap-4">
            <img src="{{ $user->profile_photo ?? 'https://via.placeholder.com/120' }}"
                 class="w-28 h-28 rounded-full object-cover">

            <div>
                <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                <p class="text-gray-600">{{ $user->study_program ?? 'Program Studi Tidak Ada' }} • {{ $user->angkatan ?? 'Angkatan' }}</p>
                <p class="mt-2 text-sm text-gray-700">{{ $user->bio ?? 'Belum ada bio.' }}</p>
            </div>
        </div>
    </div>

    {{-- Skills --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-bold mb-3">Skills</h2>

        @if($user->skills->count() > 0)
        <div class="flex gap-2 flex-wrap">
            @foreach($user->skills as $skill)
                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full">{{ $skill->name }}</span>
            @endforeach
        </div>
        @else
            <p class="text-gray-500 text-sm">Belum ada skill.</p>
        @endif
    </div>

    {{-- Portfolio --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-3">Portofolio</h2>

        @if($user->portfolios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($user->portfolios as $portfolio)
            <div class="bg-gray-100 p-4 rounded shadow">
                <img src="{{ $portfolio->image ?? 'https://via.placeholder.com/300' }}" class="rounded mb-3">
                <h3 class="font-bold text-lg">{{ $portfolio->title }}</h3>
                <p class="text-gray-600 text-sm">{{ $portfolio->description }}</p>
            </div>
            @endforeach
        </div>
        @else
            <p class="text-gray-500 text-sm">Belum ada portofolio.</p>
        @endif
    </div>

</div>

@endsection
