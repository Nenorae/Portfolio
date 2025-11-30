@extends('layouts.app')

@section('content')

<div class="flex gap-6">

    @include('components.sidebar')

    <div class="flex-1 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Portofolio Saya</h1>

        <button class="bg-green-600 text-white px-4 py-2 rounded mb-4">
            + Tambah Portofolio
        </button>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Card -->
            <div class="bg-gray-100 p-4 rounded shadow">
                <img src="https://via.placeholder.com/300" class="rounded mb-3">
                <h3 class="font-bold text-lg">Judul Proyek</h3>
                <p class="text-sm text-gray-600">Deskripsi singkat…</p>

                <div class="flex gap-2 mt-3">
                    <button class="px-3 py-1 bg-blue-500 text-white rounded">Edit</button>
                    <button class="px-3 py-1 bg-red-500 text-white rounded">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
