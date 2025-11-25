@extends('layout.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Keahlian</h2>

<form class="bg-white p-6 shadow rounded">
    <div class="mb-3">
        <label>Keahlian</label>
        <input class="w-full border p-2 rounded" value="PHP">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
