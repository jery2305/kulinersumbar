@props(['menu', 'canReview' => false])

<div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
    <!-- Gambar -->
    <div class="relative group">
        <img src="{{ asset('img/'.$menu->image) }}"
             alt="{{ $menu->name }}"
             class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105">
    </div>

    <!-- Konten -->
    <div class="p-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $menu->name }}</h3>
        <p class="text-gray-600 text-base mb-4 leading-relaxed">
            <span class="font-semibold text-red-500 text-lg">Rp {{ number_format($menu->price, 0, ',', '.') }}</span><br>
            {{ $menu->description }}
        </p>

        <!-- Tombol Pesan -->
        <form action="{{ route('cart.add') }}" method="POST" class="mb-3">
            @csrf
            <input type="hidden" name="id" value="{{ $menu->id }}">
            <input type="hidden" name="name" value="{{ $menu->name }}">
            <input type="hidden" name="price" value="{{ $menu->price }}">
            <input type="hidden" name="image" value="{{ $menu->image }}">

            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-xl transition duration-300">
                Pesan Sekarang
            </button>
        </form>

        <!-- Tombol Review -->
        <a href="{{ route('menu.reviewPage', $menu->id) }}"
           class="block w-full text-center bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-xl transition duration-300">
            Rating & Ulasan
        </a>
    </div>
</div>
