@props(['menu', 'canReview' => false])

<div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
    <img src="{{ asset('img/'.$menu->image) }}" alt="{{ $menu->name }}" class="w-full h-56 object-cover rounded-t-lg">
    <div class="p-5">
        <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $menu->name }}</h3>
        <p class="text-gray-600 mb-4">{{ 'Rp '.number_format($menu->price, 0, ',', '.') }} - {{ $menu->description }}</p>
        <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="id" value="{{ $menu->id }}">
            <input type="hidden" name="name" value="{{ $menu->name }}">
            <input type="hidden" name="price" value="{{ $menu->price }}">
            <button type="submit"
                    class="block w-full text-center bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">
                Pesan
            </button>
        </form>

        <!-- Tombol ke halaman review -->
        <a href="{{ route('menu.reviewPage', $menu->id) }}" 
            class="block w-full text-center mt-4 bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 transition">
            Rating & Ulasan
        </a>
    </div>
</div>