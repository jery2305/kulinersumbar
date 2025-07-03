<!-- Search Form -->
    <form method="GET" action="{{ route('menu.index') }}" class="mb-10 max-w-xl mx-auto">
        <div class="relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari menu khas Sumatera Barat..."
                class="w-full p-4 pl-12 pr-4 text-gray-700 bg-white border border-gray-300 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
            />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <!-- Search Icon (Heroicons) -->
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 6.65a7.5 7.5 0 010 10.6z"/>
                </svg>
            </div>
            <button
                type="submit"
                class="absolute right-2 top-2 bottom-2 bg-red-500 hover:bg-red-600 text-white px-4 rounded-lg transition"
            >
                Cari
            </button>
        </div>
    </form>
