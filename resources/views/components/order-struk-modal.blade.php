@props(['order'])

<div id="modalStruk{{ $order->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden justify-center items-center bg-black bg-opacity-50 overflow-y-auto">
    <div class="relative w-full max-w-md mx-auto p-4">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-red-500 to-yellow-500 text-white px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-9 4h6a2 2 0 012 2v5H5v-5a2 2 0 012-2h2z" />
                    </svg>
                    <h2 class="text-lg font-bold tracking-tight italic">KulinerSumbar.</h2>
                </div>
                <span class="text-sm font-medium">Order #{{ $order->id }}</span>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-4 text-sm text-gray-800">
                <!-- Tanggal -->
                <div class="flex justify-between text-xs text-gray-500">
                    <span>Tanggal:</span>
                    <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>

                <!-- Daftar Item -->
                <div>
                    <h3 class="font-semibold mb-2 text-gray-700">Detail Pesanan:</h3>
                    <ul class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            @php $sub = $item->price * $item->quantity; @endphp
                            <li class="py-2 flex justify-between items-center">
                                <div>
                                    <p class="font-medium">{{ $item->menu->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <span class="font-semibold">Rp {{ number_format($sub, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Total -->
                <div class="border-t pt-3 flex justify-between text-base font-bold text-gray-800">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center text-sm text-gray-600">
                <p class="mt-1">
                    Terima kasih telah berbelanja di 
                    <span class="font-semibold  italic text-red-600">Kuliner</span><span class="font-semibol italic text-yellow-500">Sumbar</span>.!
                </p>
                <p class="mt-1">Semoga harimu menyenangkan 🌟</p>
                <button data-modal-hide="modalStruk{{ $order->id }}" type="button"
                    class="mt-4 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-sm font-medium">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
