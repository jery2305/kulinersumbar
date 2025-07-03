<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu | Kuliner Sumbar</title>

    <!-- Styles & Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <x-navbar />

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 mt-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Daftar Menu</h2>

        <!-- Search Form -->
        <form method="GET" action="{{ route('menu.index') }}" class="mb-6 max-w-md mx-auto">
            <div class="flex items-center space-x-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari menu..."
                    class="flex-1 p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                />
                <button
                    type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-md shadow"
                >
                    Cari
                </button>
            </div>
        </form>

        <!-- Menu Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($menus as $menu)
                <x-menu-card :menu="$menu" :canReview="in_array($menu->id, $completedMenuIds)" />
            @empty
                <p class="text-center col-span-full text-gray-500">Belum ada menu yang tersedia.</p>
            @endforelse
        </div>
    </div>

    <!-- WhatsApp Button -->
    <x-wa-button />

    <!-- Footer -->
    <x-footer />

</body>
</html>
