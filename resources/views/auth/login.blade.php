<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Sumatera Barat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Tailwind & Flowbite -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-yellow-100 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
    <!-- Header -->
    <div class="text-center mb-8">
    <img src="{{ asset('img/rumah-gadang.jpg') }}" alt="Logo Sumbar" class="w-16 mx-auto mb-3">


      <h1 class="text-3xl font-extrabold text-gray-800">Login Pengguna</h1>
      <p class="text-sm text-gray-500">Selamat datang kembali di portal Sumatera Barat</p>
    </div>

      @if ($errors->any())
    <div class="mb-4 text-sm text-red-600 bg-red-100 px-4 py-2 rounded-xl border border-red-300">
      {{ $errors->first() }}
    </div>
  @endif

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
      @csrf <!-- Laravel CSRF token -->

      <!-- Email -->
      <div>
        <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" required
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-150 ease-in-out"
          placeholder="nama@email.com" />
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" required
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-150 ease-in-out"
          placeholder="••••••••" />
      </div>

      <!-- Remember & Lupa Password -->
      <div class="flex items-center justify-between">
        <label class="flex items-center text-sm text-gray-600">
          <input type="checkbox" class="mr-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" name="remember">
          Ingat saya
        </label>
        <a href="#" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
      </div>

      <!-- Tombol Login -->
      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 transition duration-200">
        Masuk
      </button>

      <!-- Register -->
      <p class="text-center text-sm text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Daftar sekarang</a>
      </p>
    </form>
  </div>

  <!-- Script Flowbite -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
