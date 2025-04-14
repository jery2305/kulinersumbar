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
<nav class="bg-white border-gray-200 shadow">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="#" class="flex items-center space-x-2 rtl:space-x-reverse">
      <span class="self-center text-2xl font-bold whitespace-nowrap text-gray-800">KulinerSumbar</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none" aria-controls="navbar-default" aria-expanded="false">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2z" clip-rule="evenodd"></path></svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">Home</a>
        </li>
        <li>
          <a href="/about" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">About</a>
        </li>
        <li>
          <a href="#menu" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">Menu</a>
        </li>
        <li>
          <a href="/contact" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">Contact</a>
        </li>
        <li>
          <a href="#cart" class="flex items-center py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">
            <svg class="w-6 h-6 mr-1 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M3 3h2l.4 2M7 13h14l-1.35 6.45a2 2 0 01-2 1.55H7a2 2 0 01-2-2v-11h16M16 16a2 2 0 110 4 2 2 0 010-4zM8 16a2 2 0 110 4 2 2 0 010-4z"/>
            </svg>
            Keranjang
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <header class="text-center py-12 bg-gradient-to-r from-red-500 to-yellow-500 text-white">
        <h2 class="text-4xl font-bold mb-4">Nikmati Kelezatan Kuliner Khas Minang!</h2>
        <p class="mb-6">Dari Rendang sampai Sate Padang — Temukan semua di sini</p>
        <a href="#menu" class="bg-white text-red-600 font-semibold py-2 px-4 rounded shadow hover:bg-gray-200">Lihat Menu</a>
    </header>

    <section id="menu" class="p-8">
        <div class="container mx-auto py-12">
    <h2 class="text-center text-3xl font-bold mb-8">Menu Kuliner Sumatera Barat</h2>
  
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
                <img src="img/dendeng-balado.jpg" class="block w-full object-contain" alt="Menu 2">
                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4 text-white">
                    <h3 class="text-xl font-semibold">Dendeng Balado</h3>
                    <p class="text-lg">Sate khas Padang dengan bumbu kacang pedas manis yang lezat.</p>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="img/es-tebak.jpg" class="block w-full object-contain" alt="Menu 3">
                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4 text-white">
                    <h3 class="text-xl font-semibold">Es-tebak</h3>
                    <p class="text-lg">Ikan segar dimasak dalam kuah gulai rempah yang kental dan kaya rasa.</p>
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

    <footer id="tentang" class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2025 Kuliner Sumbar. All rights reserved.</p>
    </footer>

</body>
</html>
