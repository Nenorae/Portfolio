@extends('layout.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Portofolio</h2>

<form class="bg-white p-6 shadow rounded">
    <div class="mb-3">
        <label>Nama Proyek</label>
        <input class="w-full border p-2 rounded" value="Proyek A">
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea class="w-full border p-2 rounded">Deskripsi...</textarea>
    </div>
    <div class="mb-3">
        <label>Link</label>
        <input class="w-full border p-2 rounded" value="https://contoh.com">
    </div>
    <div class="mb-3">
        <label>Upload Gambar Baru</label>
        <input type="file">
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
