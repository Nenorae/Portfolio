@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4 text-center">Login</h1>

    <form>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Password</label>
            <input type="password" class="w-full p-2 border rounded">
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Login
        </button>

        <p class="mt-4 text-center text-sm">
            Belum punya akun?
            <a href="/register" class="text-blue-600 underline">Register</a>
        </p>
    </form>
</div>
@endsection
