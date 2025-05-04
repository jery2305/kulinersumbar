<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <x-navbar />

    <!-- Content -->
    <div class="max-w-7xl mx-auto mt-22 px-4">
        <h2 class="text-3xl font-bold text-center mb-10 text-gray-800">Daftar Menu</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card Template -->
            <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <img src="img/rendang.jpg" alt="Rendang" class="w-full h-56 object-cover rounded-t-lg">
                <div class="p-5">
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Rendang</h3>
                    <p class="text-gray-600 mb-4">Rp 25.000 - Daging sapi berbumbu rempah kaya rasa</p>
                      <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                          @csrf
                          <input type="hidden" name="id"    value="1">
                          <input type="hidden" name="name"  value="Rendang">
                          <input type="hidden" name="price" value="25000">
                          <button type="submit"
                              class="block w-full text-center bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">
                              Pesan
                          </button>
                      </form>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <img src="img/sate-padang.jpg" alt="Sate Padang" class="w-full h-56 object-cover rounded-t-lg">
                <div class="p-5">
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Sate Padang</h3>
                    <p class="text-gray-600 mb-4">Rp 20.000 - Sate daging sapi dengan kuah kental khas Minang</p>
                      <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="id"    value="2">
                            <input type="hidden" name="name"  value="Sate Padang">
                            <input type="hidden" name="price" value="20000">
                            <button type="submit"
                                class="block w-full text-center bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">
                                Pesan
                            </button>
                      </form>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <img src="img/dendeng-balado.jpg" alt="Dendeng Balado" class="w-full h-56 object-cover rounded-t-lg">
                <div class="p-5">
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Dendeng Balado</h3>
                    <p class="text-gray-600 mb-4">Rp 30.000 - Daging sapi iris tipis dengan sambal balado pedas</p>
                      <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="id"    value="3">
                            <input type="hidden" name="name"  value="Dendeng Balado">
                            <input type="hidden" name="price" value="30000">
                            <button type="submit"
                                class="block w-full text-center bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">
                                Pesan
                            </button>
                      </form>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

</body>
</html>
