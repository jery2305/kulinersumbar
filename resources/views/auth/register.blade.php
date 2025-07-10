<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi - Sumatera Barat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Tailwind & Flowbite -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-yellow-100 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
    <!-- Header -->
    <div class="text-center mb-6">
   
      <h1 class="text-3xl font-extrabold text-gray-800">Formulir Pendaftaran</h1>
      <p class="text-sm text-gray-500">Silakan isi data Anda dengan benar</p>
    </div>

    <!-- Flash Success -->
    @if(session('success'))
      <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm">
        {{ session('success') }}
      </div>
    @endif

    <!-- Form Register -->
    <form method="POST" action="{{ url('/register') }}" class="space-y-5">
      @csrf

      <!-- Nama -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
        <input type="text" id="name" name="name"
               value="{{ old('name') }}"
               class="w-full p-3 text-sm border rounded-xl focus:ring-blue-500 focus:border-blue-500 bg-gray-50 @error('name') border-red-500 @enderror" required>
        @error('name')
          <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" id="email" name="email"
               value="{{ old('email') }}"
               class="w-full p-3 text-sm border rounded-xl focus:ring-blue-500 focus:border-blue-500 bg-gray-50 @error('email') border-red-500 @enderror" required>
        @error('email')
          <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Role -->
      <input type="hidden" name="role" value="user">

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
        <input type="password" id="password" name="password"
               class="w-full p-3 text-sm border rounded-xl focus:ring-blue-500 focus:border-blue-500 bg-gray-50 @error('password') border-red-500 @enderror" required>
        @error('password')
          <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Konfirmasi Password -->
      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
               class="w-full p-3 text-sm border rounded-xl focus:ring-blue-500 focus:border-blue-500 bg-gray-50" required>
      </div>

      <!-- Tombol Daftar -->
      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 transition duration-200">
        Daftar
      </button>

      <!-- Sudah punya akun -->
      <p class="text-center text-sm text-gray-600 mt-4">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login di sini</a>
      </p>
    </form>
  </div>

  <!-- Flowbite JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
