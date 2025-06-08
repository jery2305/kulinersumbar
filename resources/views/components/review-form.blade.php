@props(['menu', 'success'])

<!-- Komponen Blade: x-review-form -->
<div class="mt-6 border-t pt-4">

        <form action="{{ route('menu.addReview', $menu->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="rating" class="block text-sm text-gray-700">Rating:</label>
                <div class="flex flex-row-reverse justify-end space-x-reverse space-x-1">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}-{{ $menu->id }}" name="rating" value="{{ $i }}" class="hidden peer" {{ $i === 1 ? 'required' : '' }} />
                        <label for="star{{ $i }}-{{ $menu->id }}" 
                            class="text-3xl text-gray-300 cursor-pointer hover:text-yellow-400 peer-checked:text-yellow-500 transition">
                            ★
                        </label>
                    @endfor

                    @error('rating')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            
            <div class="mb-4">
                <label for="review" class="block text-sm text-gray-700">Ulasan:</label>
                <textarea name="review" id="review" class="w-full mt-2 px-4 py-2 border rounded" rows="3" placeholder="Tulis ulasan Anda...">{{ old('review') }}</textarea>
                @error('review')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="block w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">
                Kirim Ulasan
            </button>
        </form>

        @if($success)
            <div class="mt-4 text-green-500">
                {{ $success }}
            </div>
        @endif

     <!-- Toggle Ulasan -->
    <div class="mt-6">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-800">Ulasan Pelanggan:</h4>
            <button type="button" onclick="toggleReviews('{{ $menu->id }}')" class="text-gray-600 hover:text-blue-600 transition">
                <!-- Ikon mata dari Heroicons -->
                <svg id="toggle-icon-{{ $menu->id }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>

        </div>

        <div id="review-section-{{ $menu->id }}" class="space-y-4 hidden">
            @forelse($menu->ratings as $rating)
                <div class="flex items-start space-x-4 bg-white p-4 rounded-lg shadow-sm border">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($rating->user->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>

                    <div class="flex-1">
                        <!-- Bintang dan Tanggal -->
                        <div class="flex items-center space-x-2">
                            <div class="text-yellow-500 text-lg">
                                {{ str_repeat('★', $rating->rating) }}
                                {{ str_repeat('☆', 5 - $rating->rating) }}
                            </div>
                            <span class="text-sm text-gray-500">({{ $rating->created_at->format('d M Y') }})</span>
                        </div>

                        <!-- Isi Ulasan -->
                        <p class="mt-2 text-gray-700 leading-relaxed">
                            {{ $rating->review }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Belum ada ulasan untuk menu ini.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Script toggle -->
<script>
    function toggleReviews(menuId) {
        const section = document.getElementById('review-section-' + menuId);
        section.classList.toggle('hidden');

        // Contoh untuk toggle ikon (jika ada variasi ikon)
        const icon = document.getElementById('toggle-icon-' + menuId);
        // Di sini bisa kamu ubah kelas SVG kalau punya 2 versi ikon mata
    }
</script>