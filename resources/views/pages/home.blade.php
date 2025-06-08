<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed tracking-wide">

    <!-- Navbar -->
    <x-navbar />

    <header class="text-center py-12 bg-gradient-to-r from-red-500 to-yellow-500 text-white">
        <h2 class="text-4xl font-bold mb-4">Nikmati Kelezatan Kuliner Khas Minang!</h2>
        <p class="mb-6">Dari Rendang sampai Sate Padang — Temukan semua di sini</p>
        <a href="/menu" class="bg-white text-red-600 font-semibold py-2 px-4 rounded shadow hover:bg-gray-200">Lihat Menu</a>
    </header>

    <!-- Rekomendasi Kuliner -->
    <x-menu-recommended :recommendedMenus="$recommendedMenus" />
    
    <!-- Menu Price -->
     <x-menu-price />

    <!-- About-Section -->
    <x-about-section />

    <!-- Footer -->
    <x-footer />

    <!-- Floating FAQ Button -->
     <x-faq-button />

</body>
</html>
