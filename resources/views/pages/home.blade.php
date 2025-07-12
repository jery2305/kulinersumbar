<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="relative bg-gray-100 font-sans leading-relaxed tracking-wide">

    <!-- Navbar -->
    <x-navbar />

    <header class="relative text-center text-white overflow-hidden shadow-lg h-[500px] flex items-center justify-center">
    
    <!-- Background Video -->
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-0">
        <source src="{{ asset('videos/rendang-padang.mp4') }}" type="video/mp4">
        Browser Anda tidak mendukung video.
    </video>

    <!-- Overlay hitam transparan agar teks tetap jelas -->
    <div class="absolute inset-0 bg-black/40 z-10"></div>

    <!-- Konten Header -->
    <div class="relative z-20 px-4">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-md animate-fade-in">
            Nikmati Kelezatan Kuliner Khas Minang!
        </h2>
        <p class="mb-6 text-lg md:text-xl text-white/90 animate-fade-in delay-100">
            Jelajahi cita rasa khas Minang dalam setiap hidangan favorit Anda.
        </p>
        <a href="/menu" 
           class="inline-block bg-white text-red-600 font-semibold py-2 px-6 rounded-full shadow-lg hover:bg-yellow-100 transition duration-300 animate-fade-in delay-200">
            Lihat Menu
        </a>
        
    </div>
</header>


    <!-- Rekomendasi Kuliner -->
    <x-menu-recommended :recommendedMenus="$recommendedMenus" />
    
    <!-- About-Section -->
    <x-about-section />

    <!-- galeri -->
     <x-galeri />

    <!-- Footer -->
    <x-footer />

    <!-- Floating WhatsApp Button -->
    <x-wa-button />

    <!-- Floating FAQ Button -->
    <x-faq-button />

</body>
</html>
