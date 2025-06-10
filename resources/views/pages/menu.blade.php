<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu| Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <x-navbar />

    <!-- Content -->
    <div class="max-w-7xl mx-auto mt-22 px-4">
        <h2 class="text-3xl font-bold text-center mb-8 mt-6 text-gray-800">Daftar Menu</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($menus as $menu)
                <x-menu-card :menu="$menu" :canReview="in_array($menu->id, $completedMenuIds)" />
            @empty
                <p class="text-center col-span-full text-gray-500">Belum ada menu yang tersedia.</p>
            @endforelse
        </div>
    </div>

    <x-footer />

</body>
</html>