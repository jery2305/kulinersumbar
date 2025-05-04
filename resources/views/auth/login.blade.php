<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Sumatera Barat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1517511620798-cec17d428bc0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');">

    <div class="bg-white bg-opacity-90 backdrop-blur-sm p-10 rounded-2xl shadow-2xl max-w-md w-full text-center">
        
        <!-- Logo Rumah Gadang -->
        <img src="{{ asset('img/rumah-gadang.jpg') }}" alt="Logo Rumah Gadang" class="w-60 h-60 mx-auto mb-2">

        <h2 class="text-3xl font-extrabold text-gray-800 mb-6">Selamat Datang</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4 text-left">
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" required autocomplete="email"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-6 text-left">
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" required autocomplete="current-password"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Belum punya akun?</p>
            <a href="{{ route('register') }}"
               class="mt-2 inline-block text-white bg-green-500 py-2 px-5 rounded-lg hover:bg-green-600 transition font-semibold">
                Daftar Sekarang
            </a>
        </div>
    </div>

</body>
</html>
