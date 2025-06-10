<div class="mt-6 border-t pt-4">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Review Menu</h2>

    @if(session('success') && session('menu_id') == $menu->id)
        <div id="review-success" class="mt-4 px-4 py-2 max-w-md text-green-600 bg-green-100 rounded text-center text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Review -->
    <form action="{{ route('menu.addReview', $menu->id) }}#review-success" method="POST" class="mb-6">
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

    <!-- Daftar Ulasan Pelanggan -->
    <div class="mt-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">Ulasan Pelanggan:</h4>
        <div class="space-y-4">
            @forelse($menu->ratings as $rating)
                <div class="flex items-start space-x-4 bg-white p-4 rounded-lg shadow-sm border">
                    <!-- Avatar User -->
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($rating->user->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>

                    <!-- Konten Review -->
                    <div class="flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <!-- Nama & Rating -->
                            <div class="flex items-center space-x-2">
                                <strong class="text-gray-800">{{ $rating->user->name ?? 'User' }}</strong>
                                <div class="text-yellow-500 text-lg leading-none">
                                    {{ str_repeat('★', $rating->rating) }}
                                    {{ str_repeat('☆', 5 - $rating->rating) }}
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <span class="text-sm text-gray-500 mt-1 sm:mt-0">
                                {{ $rating->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <!-- Isi Review -->
                        <p class="mt-2 text-gray-700 leading-relaxed">{{ $rating->review }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Belum ada ulasan untuk menu ini.</p>
            @endforelse
        </div>

    <!-- Tombol Kembali -->
    <div class="mt-8">
        <a href="/menu" 
            class="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                ← Kembali ke Menu
         </a>
    </div>
</div>

