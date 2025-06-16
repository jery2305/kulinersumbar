@props(['order'])

<div id="modalStruk{{ $order->id }}" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full overflow-y-auto overflow-x-hidden justify-center items-center bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            
            <!-- Header with Logo -->
            <div class="bg-blue-600 text-white px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <!-- Tailwind Heroicon - Home Icon (bisa dianggap logo rumah gadang) -->
                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-9 4h6a2 2 0 012 2v5H5v-5a2 2 0 012-2h2z" />
                    </svg>
                    <h2 class="text-lg font-bold italic tracking-tight">KulinerSumbar</h2>.
                </div>
                <span class="text-sm">Order #{{ $order->id }}</span>
            </div>


            <!-- Body -->
            <div class="p-6 space-y-4 text-gray-800 text-sm">
                <!-- Tanggal -->
                <div class="flex justify-between text-xs text-gray-500">
                    <span>Tanggal:</span>
                    <span>{{ $order->created_at->format('d M Y H:i') }}</span>
                </div>

                <!-- Daftar Item -->
                <div>
                    <h3 class="font-semibold mb-2">Detail Pesanan:</h3>
                    <ul class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            @php $sub = $item->price * $item->quantity; @endphp
                            <li class="py-2 flex justify-between">
                                <span>{{ $item->quantity }} x {{ $item->menu->name }}</span>
                                <span>Rp {{ number_format($sub, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Total -->
                <div class="flex justify-between font-bold text-base border-t pt-3">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center text-sm text-gray-600">
                <p>Terima kasih telah berbelanja di <strong>Kuliner Sumbar</strong>! 🍽️</p>
                <p class="mt-1">Semoga harimu menyenangkan 🌟</p>
                <button data-modal-hide="modalStruk{{ $order->id }}" type="button"
                    class="mt-4 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-sm font-medium">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
