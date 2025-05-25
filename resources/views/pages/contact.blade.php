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
      Punya pertanyaan atau pesan? Kirimkan langsung melalui form berikut.</p>

    @if(session('success'))
      <div class="bg-green-500 text-white p-4 mb-6 rounded text-center">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="nama" class="block mb-2 font-medium text-gray-800">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div>
          <label for="email" class="block mb-2 font-medium text-gray-800">Email</label>
          <input type="email" id="email" name="email" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
      </div>

      <div>
        <label for="pesan" class="block mb-2 font-medium text-gray-800">Pesan Anda</label>
        <textarea id="pesan" name="pesan" rows="5" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required></textarea>
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
  <x-footer />

</body>
</html>
