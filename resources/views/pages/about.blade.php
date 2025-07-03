@extends('layouts.app')

@section('title', 'About')

@section('content')
<!-- About Section -->
<section class="max-w-4xl mx-auto p-8 rounded-lg shadow-lg mt-3 bg-white">
  <!-- Gambar Kuliner -->
  <img src="{{ asset('img/about.jpg') }}"
     alt="Rendang Minang"
     class="w-full max-w-md md:max-w-lg lg:max-w-xl mx-auto rounded-lg mb-6 shadow-xl transition-transform duration-500 hover:scale-105">

  <h1 class="text-4xl font-extrabold text-black mb-4 text-center hover:scale-105 transition-transform duration-300">
    Tentang Kami
  </h1>

  <p class="text-black mb-4 text-lg leading-relaxed">
    <strong>KulinerSumbar</strong> adalah sebuah platform digital yang bertujuan untuk memperkenalkan dan mempromosikan kekayaan kuliner khas Minangkabau kepada masyarakat luas. Website ini menghadirkan berbagai macam hidangan tradisional dari Sumatera Barat yang telah melegenda, seperti <em>Rendang, Sate Padang, Dendeng Batokok, Itiak Lado Mudo</em>, hingga makanan ringan seperti <em>Karupuak Sanjai</em>.
  </p>

  <p class="text-black mb-4 text-lg leading-relaxed">
    Website ini dibangun sebagai bagian dari proyek <strong>Project-Based Learning</strong> oleh mahasiswa Program Studi Informatika. Kami ingin menggabungkan teknologi dengan budaya untuk menciptakan media informasi yang tidak hanya menarik secara visual, tetapi juga bermanfaat sebagai sarana edukasi bagi masyarakat, khususnya generasi muda, agar lebih mengenal budaya kuliner daerahnya sendiri.
  </p>

  <p class="text-black mb-4 text-lg leading-relaxed">
    Selain menampilkan informasi mengenai berbagai makanan, KulinerSumbar juga dilengkapi fitur interaktif seperti penilaian menu, ulasan pengguna, dan bahkan simulasi pemesanan untuk mendekatkan pengalaman pengguna dengan dunia kuliner Minang. Kami percaya bahwa dengan pendekatan digital, promosi budaya dapat dilakukan secara lebih luas, efektif, dan menyenangkan.
  </p>

  <p class="text-black mb-4 text-lg leading-relaxed">
    Harapan kami, KulinerSumbar tidak hanya menjadi katalog kuliner digital, tetapi juga menjadi jembatan antara tradisi dan teknologi, serta turut andil dalam pelestarian identitas kuliner lokal Indonesia di tengah arus globalisasi.
  </p>

  <p class="text-black mb-4 text-lg leading-relaxed">
    Terima kasih telah mengunjungi website ini. Selamat menjelajahi cita rasa khas Minangkabau bersama KulinerSumbar!
  </p>
</section>

<!-- Tombol Kembali ke Home -->
<x-back-home />
@endsection
