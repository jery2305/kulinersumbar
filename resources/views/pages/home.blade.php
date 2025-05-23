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

    <!-- Menu Carousel -->
    <x-menu-carousel />
    
    <!-- Menu Price -->
     <x-menu-price />

    <!-- About-Section -->
    <x-about-section />

<!-- Toggle ala FAQ (Flowbite Collapse) -->
<div id="team-toggle" class="max-w-2xl mx-auto my-12 px-4">
    <h2 id="accordion-team-heading">
        <button type="button" class="flex items-center justify-between w-full p-2.5 font-normal text-left text-gray-900 border border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 transition" data-collapse-toggle="team-content" aria-expanded="false" aria-controls="team-content">
            <span class="text-base">Kenali Tim Pengembang</span>
            <svg data-accordion-icon class="w-4 h-4 shrink-0 rotate-0 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" /></svg>
        </button>
    </h2>
    <div id="team-content" class="hidden" aria-labelledby="accordion-team-heading">
        <div class="p-4 border border-t-0 border-gray-200 bg-white rounded-b-xl relative">
            <div class="relative">
                <img src="img/team.jpg" alt="Team Background" class="w-full object-cover h-48 opacity-80 rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-30 rounded-lg"></div>
                <div class="absolute inset-0 flex justify-center items-center text-center px-3 py-4">
                    <div>
                        <p class="text-sm text-white mb-4">Kami adalah tim yang berdedikasi untuk memberikan pengalaman kuliner di Sumatera Barat!</p>
                        <a href="{{ route('team') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-5 rounded-lg shadow-lg transition duration-300 transform hover:scale-105 text-sm">
                            Lihat Tim Pengembang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Footer -->
    <x-footer />

    <!-- Floating FAQ Button -->
     <x-faq-button />

</body>
</html>
