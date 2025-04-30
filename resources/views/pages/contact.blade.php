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
        <div>
          <label for="name" class="block mb-2 font-medium text-gray-800">Nama Lengkap</label>
          <input type="text" id="name" name="name" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div>
          <label for="email" class="block mb-2 font-medium text-gray-800">Email</label>
          <input type="email" id="email" name="email" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
      </div>

      <div>
        <label for="message" class="block mb-2 font-medium text-gray-800">Pesan Anda</label>
        <textarea id="message" name="message" rows="5" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required></textarea>
      </div>

      <div class="text-center">
        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
          Kirim Pesan
        </button>
      </div>
    </form>

    <div class="mt-8 text-center">
      <p class="text-gray-600">Atau hubungi kami langsung di:</p>
      <p class="text-gray-800 font-semibold">Email: support@kulinersumbar.com</p>
      <p class="text-gray-800 font-semibold">Telepon: (021) 123-456-789</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white p-4 text-center mt-16">
    <p>&copy; 2025 Kuliner Sumbar. All rights reserved.</p>
  </footer>

</body>
</html>
