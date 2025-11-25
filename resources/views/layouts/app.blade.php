<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MahaKarya</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow-md p-4 flex justify-between">
        <a href="/" class="font-bold text-xl">MahaKarya</a>

        <div class="space-x-4 flex items-center">

            <a href="/login" class="text-blue-600 hover:underline">Login</a>
            <a href="/register" class="text-blue-600 hover:underline">Register</a>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">
                    Logout
                </button>
            </form>

        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>

