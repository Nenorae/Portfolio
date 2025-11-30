<div class="w-60 h-screen bg-white p-4 shadow rounded">
    <h2 class="text-xl font-bold mb-4">Menu</h2>

    <ul class="space-y-2">
        <li>
            <a href="/dashboard" class="block p-2 hover:bg-gray-100 rounded">
                Dashboard
            </a>
        </li>

        <li>
            <a href="/portfolio" class="block p-2 hover:bg-gray-100 rounded">
                Portofolio
            </a>
        </li>

        <li>
            <a href="/skills" class="block p-2 hover:bg-gray-100 rounded">
                Keahlian
            </a>
        </li>

        <li>
            <a href="/profile" class="block p-2 hover:bg-gray-100 rounded">
                Edit Profil
            </a>
        </li>

        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left block p-2 hover:bg-gray-100 rounded text-red-600">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>

