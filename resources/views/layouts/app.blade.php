<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Kuliner Sumbar')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet" />
</head>
<body class="bg-gray-50 font-sans">

    <x-navbar />

    <main class="max-w-7xl mx-auto px-4 mt-6">
        @yield('content')
    </main>

    <x-footer />

</body>
</html>
