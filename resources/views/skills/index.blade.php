@extends('layouts.app')

@section('content')
<div class="flex gap-6">

    @include('components.sidebar')

    <div class="flex-1 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Keahlian Saya</h1>

        <form class="flex gap-3 mb-4">
            <input type="text" placeholder="Tambah skill..." class="p-2 border rounded w-full">
            <button class="bg-green-600 text-white px-4 py-2 rounded">Tambah</button>
        </form>

        <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                Laravel
            </span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                PHP
            </span>
        </div>
    </div>

</div>
@endsection
