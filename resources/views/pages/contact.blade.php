<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | Kuliner Sumbar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

  <!-- Floating WhatsApp Button -->
  <x-wa-button />

  <!-- Footer -->
  <x-footer />

</body>
</html>
