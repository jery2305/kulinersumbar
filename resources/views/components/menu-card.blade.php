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

        <!-- Ulasan dan Rating -->
        @if($canReview)
            <x-review-form 
                :menu="$menu" 
                :success="session('success_menu_id') === $menu->id ? session('success') : null"/>
        @else
            <div class="mt-4 border-t pt-4 text-sm text-gray-500 italic">
                <span class="text-yellow-600 mr-2">🔒</span>
                Anda harus memesan menu ini terlebih dahulu dan pesanan dikonfirmasi <strong>selesai</strong> sebelum bisa memberi ulasan.
            </div>
        @endif

    </div>
</div>