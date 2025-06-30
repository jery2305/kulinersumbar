<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | Kuliner Sumbar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-50">

  <!-- Navbar -->
  <x-navbar />

  <!-- Contact Section -->
  <section class="max-w-4xl mx-auto p-8 mt-10 bg-white rounded-lg shadow-lg border">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-4 text-center">Hubungi Kami</h1>
    <p class="text-gray-600 text-center mb-8">
      Punya pertanyaan atau pesan? Kirimkan langsung melalui form berikut.
    </p>

    @if(session('success'))
      <div class="bg-green-500 text-white p-4 mb-6 rounded text-center">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @auth
          <!-- Input nama dan email sudah terisi dan readonly -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ Auth::user()->name }}" readonly 
              class="mt-1 block w-full border border-gray-300 rounded-lg p-3 bg-gray-100 cursor-not-allowed">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}" readonly 
              class="mt-1 block w-full border border-gray-300 rounded-lg p-3 bg-gray-100 cursor-not-allowed">
          </div>
        @else
          <div>
            <label for="nama" class="block mb-2 font-medium text-gray-800">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
          </div>
          <div>
            <label for="email" class="block mb-2 font-medium text-gray-800">Email</label>
            <input type="email" id="email" name="email" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
          </div>
        @endauth
      </div>

      <div class="relative">
        <label for="pesan" class="block mb-2 font-medium text-gray-800">Pesan Anda</label>
        <div class="relative">
          <div class="absolute top-3 left-3 text-gray-400">
            <!-- Heroicons message icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <textarea id="pesan" name="pesan" rows="5"
            class="w-full p-3 pl-10 border rounded-lg focus:ring-2 focus:ring-blue-500"
            required></textarea>
        </div>
      </div>

      <div class="text-center">
        @auth
          <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
            Kirim Pesan
          </button>
        @else
          <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-400">
            Kirim Pesan
          </a>
        @endauth
      </div>
    </form>

    <div class="mt-8 text-center">
      <p class="text-gray-600">Atau hubungi kami langsung di:</p>
      <p class="text-gray-800 font-semibold">Email: support@kulinersumbar.com</p>
      <p class="text-gray-800 font-semibold">Telepon: (021) 123-456-789</p>
    </div>
  </section>
  
<a href="https://wa.me/6289623255564?text=Halo%20admin,%20saya%20ingin%20bertanya%20tentang%20produk%20Anda." target="_blank"
   class="fixed bottom-20 right-5 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg z-50">
    <!-- Icon WhatsApp -->
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path
            d="M20.52 3.48A11.89 11.89 0 0012 0C5.37 0 0 5.37 0 12a11.86 11.86 0 001.7 6.1L0 24l6.32-1.66A11.93 11.93 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.2-3.48-8.52zM12 21.6a9.6 9.6 0 01-4.91-1.34l-.35-.2-3.75.98 1-3.66-.23-.38A9.59 9.59 0 1121.6 12c0 5.29-4.31 9.6-9.6 9.6zm5.18-7.26l-1.48-.75c-.2-.1-.43-.17-.66-.09-.21.07-.33.25-.46.41l-.17.21c-.12.15-.27.16-.44.09-1.2-.5-2.1-1.35-2.67-2.51-.1-.21-.1-.39.05-.56.08-.1.19-.22.27-.33.08-.1.18-.22.2-.35.03-.13 0-.28-.06-.4l-.64-1.44c-.15-.33-.53-.5-.86-.39l-.35.1a2.43 2.43 0 00-1.7 2.27c0 .45.12.9.34 1.3 1.14 2.15 3 3.77 5.26 4.63.4.15.82.22 1.23.22.5 0 .99-.13 1.42-.38a2.3 2.3 0 001.06-1.33c.1-.34-.02-.71-.35-.87z" />
    </svg>
</a>

  <!-- Footer -->
  <x-footer />

</body>
</html>
