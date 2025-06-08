@props(['recommendedMenus'])

<h2 class="text-2xl text-center font-bold mb-8 mt-6">Rekomendasi Kuliner Terbaik</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @if($recommendedMenus->isEmpty())
        <p class="col-span-full text-center text-gray-500 italic">
            Belum ada menu yang bisa direkomendasikan karena belum ada rating.
        </p>
    @else
        @foreach($recommendedMenus as $menu)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-4 relative group">
                <img src="{{ asset('img/'.$menu->image) }}" alt="{{ $menu->name }}"
                     class="w-full h-48 object-cover rounded-xl mb-4 transition-transform duration-300 group-hover:scale-105">

                <div class="flex flex-col items-start space-y-1">
                    <h3 class="text-lg font-bold text-gray-800">{{ $menu->name }}</h3>
                    <p class="text-sm text-gray-600">{{ 'Rp '.number_format($menu->price,0,',','.') }}</p>
                    <div class="flex items-center text-yellow-500 text-sm">
                        ⭐ {{ number_format($menu->ratings_avg_rating, 1) }} / 5
                    </div>
                </div>
                <div class="absolute top-2 right-2 bg-yellow-400 text-xs text-white px-2 py-1 rounded-full shadow">
                    Rekomendasi
                </div>
            </div>
        @endforeach
    @endif
</div>

