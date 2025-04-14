<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami | Kuliner Sumbar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-50">

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
          <a href="/" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">Home</a>
        </li>
        <li>
          <a href="/about" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">About</a>
        </li>
        <li>
          <a href="/menu" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">Menu</a>
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

<!<!-- About Section -->
<section class="max-w-4xl mx-auto p-8 rounded-lg shadow-lg mt-3">
  <!-- Gambar Kuliner -->
  <img src="img/about.jpg" alt="Rendang Minang" class="rounded-lg mb-6 w-3/4 mx-auto shadow-xl transition-transform duration-500">

  <h1 class="text-4xl font-extrabold text-black mb-4 text-center">Tentang Kami</h1>
  <p class="text-black mb-4 text-lg leading-relaxed">
    KulinerSumbar adalah website yang menghadirkan berbagai menu khas Minangkabau, mulai dari Rendang, Sate Padang, hingga Picaladang.
    Kami berkomitmen untuk mengenalkan dan memudahkan Anda menikmati kelezatan kuliner asli Sumatera Barat.
  </p>
  <p class="text-black mb-4 text-lg leading-relaxed">
    Website ini dikembangkan oleh mahasiswa Informatika sebagai media promosi dan edukasi budaya kuliner Indonesia, khususnya dari Sumatera Barat.
    Kami berharap melalui platform ini, budaya kuliner Minang semakin dikenal dan dicintai di berbagai penjuru Nusantara.
  </p>

  <div class="mt-6 text-black">
    <h2 class="text-2xl font-semibold mb-2">Visi</h2>
    <p class="mb-4">Menjadi platform digital terbaik dalam mengenalkan kuliner Minangkabau ke seluruh Indonesia.</p>

    <h2 class="text-2xl font-semibold mb-2">Misi</h2>
    <ul class="list-disc list-inside">
      <li>Menyajikan informasi kuliner Minang yang akurat dan menarik.</li>
      <li>Membantu pelaku usaha kuliner lokal untuk lebih dikenal secara online.</li>
      <li>Mengedukasi masyarakat tentang kekayaan budaya kuliner Sumatera Barat.</li>
    </ul>
  </div>
</section>


<footer id="tentang" class="bg-gray-800 text-white p-4 text-center mt-12">
    <p>&copy; 2025 Kuliner Sumbar. All rights reserved.</p>
</footer>

</body>
</html>
