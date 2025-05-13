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

    <section id="menu" class="p-8">
        <div class="container mx-auto py-12">
    <h2 class="text-center text-3xl font-bold mb-8">Menu Kulliner Sumatera Barat</h2>
  
    <!-- Flowbite Carousel -->
    <div id="menu-carousel" class="relative" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Slide 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="img/rendang.jpg" class="block w-full object-contain" alt="Menu 1">
                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4 text-white">
                    <h3 class="text-xl font-semibold">Rendang</h3>
                    <p class="text-lg">Daging sapi dimasak dengan santan dan rempah pilihan khas Minang.</p>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="img/dendeng_balado.jpg" class="block w-full object-contain" alt="Menu 2">
                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4 text-white">
                    <h3 class="text-xl font-semibold">Dendeng Balado</h3>
                    <p class="text-lg">Irisan tipis daging sapi yang digoreng kering, disajikan dengan sambal balado pedas khas Padang.</p>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="img/es_tebak.jpg" class="block w-full object-contain" alt="Menu 3">
                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4 text-white">
                    <h3 class="text-xl font-semibold">Es-tebak</h3>
                    <p class="text-lg">Minuman segar khas Sumatera Barat berisi campuran es serut, tebak (cendol), sirup, santan, dan topping manis lainnya.</p>
                </div>
            </div>
        </div>
        <!-- Carousel indicators -->
        <div class="absolute z-30 flex space-x-2 transform -translate-x-1/2 left-1/2 bottom-5">
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" data-carousel-slide-to="2"></button>
        </div>
    </div>
</div>

    </section>

    <x-footer />

</body>
</html>
