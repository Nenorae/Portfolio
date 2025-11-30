@extends('layouts.app', ['title' => 'Edit Profil'])

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Profil</h2>

<form class="bg-white p-6 shadow rounded">
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Bio</label>
        <textarea class="w-full border p-2 rounded"></textarea>
    </div>

    <div class="mb-3">
        <label>Foto Profil</label>
        <input type="file">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
