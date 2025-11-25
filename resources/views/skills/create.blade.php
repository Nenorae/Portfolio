@extends('layout.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Keahlian</h2>

<form class="bg-white p-6 shadow rounded">
    <div class="mb-3">
        <label>Keahlian</label>
        <input class="w-full border p-2 rounded">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
