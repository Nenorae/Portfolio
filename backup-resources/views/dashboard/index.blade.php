@extends('layouts.app')

@section('content')
<div class="flex gap-6">

    <aside class="w-64 h-screen bg-white shadow p-5 rounded">
        <h2 class="font-bold text-xl mb-4">Dashboard</h2>

        <ul class="space-y-3">
            <li><a href="/dashboard" class="block px-2 py-1 hover:bg-gray-200 rounded">Dashboard</a></li>
            <li><a href="/profile" class="block px-2 py-1 hover:bg-gray-200 rounded">Profil</a></li>
            <li><a href="/portfolio" class="block px-2 py-1 hover:bg-gray-200 rounded">Portofolio</a></li>
            <li><a href="/skills" class="block px-2 py-1 hover:bg-gray-200 rounded">Keahlian</a></li>
        </ul>
    </aside>

    <div class="flex-1 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang di Dashboard!</h1>

        <p class="text-gray-600 mb-6">
            Silakan kelola portofolio, keahlian, dan profilmu melalui menu di sebelah kiri.
        </p>

        <div class="grid grid-cols-3 gap-6">
            <div class="p-5 bg-blue-100 rounded shadow text-center">
                <h3 class="font-bold">Profil</h3>
                <p class="text-sm text-gray-700 mb-3">Update biodata kamu</p>
                <a href="/profile" class="text-blue-700 underline">Kelola</a>
            </div>

            <div class="p-5 bg-green-100 rounded shadow text-center">
                <h3 class="font-bold">Portofolio</h3>
                <p class="text-sm text-gray-700 mb-3">Tambahkan karya terbaikmu</p>
                <a href="/portfolio" class="text-green-700 underline">Kelola</a>
            </div>

            <div class="p-5 bg-yellow-100 rounded shadow text-center">
                <h3 class="font-bold">Keahlian</h3>
                <p class="text-sm text-gray-700 mb-3">Tampilkan skill kamu</p>
                <a href="/skills" class="text-yellow-700 underline">Kelola</a>
            </div>
        </div>

    </div>
</div>
@endsection

