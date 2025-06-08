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

<!-- About Section -->
<section class="max-w-4xl mx-auto p-8 rounded-lg shadow-lg mt-3">
  <!-- Gambar Kuliner -->
  <img src="img/about.jpg"
     alt="Rendang Minang"
     class="w-full max-w-md md:max-w-lg lg:max-w-xl mx-auto rounded-lg mb-6 shadow-xl transition-transform duration-500 hover:scale-105">

  <h1 class="text-4xl font-extrabold text-black mb-4 text-center hover:scale-105 transition-transform duration-300">
    Tentang Kami
  <h1>
  <p class="text-black mb-4 text-lg leading-relaxed">
    KulinerSumbar adalah website yang menghadirkan berbagai menu khas Minangkabau, mulai dari Rendang, Sate Padang, hingga Picaladang.
    Kami berkomitmen untuk mengenalkan dan memudahkan Anda menikmati kelezatan kuliner asli Sumatera Barat.
  </p>
  <p class="text-black mb-4 text-lg leading-relaxed">
    Website ini dikembangkan oleh mahasiswa Informatika sebagai media promosi dan edukasi budaya kuliner Indonesia, khususnya dari Sumatera Barat.
    Kami berharap melalui platform ini, budaya kuliner Minang semakin dikenal dan dicintai di berbagai penjuru Nusantara.
  </p>

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
</section>

<!-- Tombol Kembali ke Home -->
 <x-back-home />

<!-- Footer -->
<x-footer />

</body>
</html>
