@extends('layout.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Portofolio</h2>

<form class="bg-white p-6 shadow rounded">
    <div class="mb-3">
        <label>Nama Proyek</label>
        <input class="w-full border p-2 rounded">
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea class="w-full border p-2 rounded"></textarea>
    </div>
    <div class="mb-3">
        <label>Link</label>
        <input class="w-full border p-2 rounded">
    </div>
    <div class="mb-3">
        <label>Gambar</label>
        <input type="file">
    </div>
    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
