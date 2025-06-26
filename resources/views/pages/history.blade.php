<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Histori Pemesanan - Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-50 font-sans">
    <x-navbar />

    <div class="max-w-5xl mx-auto py-12 px-6">
        <h1 class="text-4xl font-extrabold text-center text-black-700 mb-10">Histori Pemesanan</h1>

        @if($orders->isEmpty())
            <div class="text-center text-gray-600 text-lg">
                Anda belum melakukan pemesanan.
            </div>
        @else
            <div class="space-y-8">
                @foreach($orders as $order)
                    <div class="flex flex-col md:flex-row bg-white border-l-4 shadow-lg rounded-lg p-6 
                        @class([
                                'border-yellow-400' => $order->status === 'Menunggu Pembayaran',
                                'border-blue-500' => $order->status === 'Diproses',
                                'border-purple-500' => $order->status === 'Dikirim',
                                'border-green-500' => $order->status === 'Selesai',
                                'border-gray-400' => $order->status === 'Dibatalkan',
                        ])">

                        <!-- Informasi Waktu & Status -->
                        <div class="md:w-1/3 mb-4 md:mb-0 md:pr-6 border-r md:border-r-gray-200">
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>

                            @if(in_array($order->status, ['Diproses', 'Dikirim', 'Selesai']) && $order->resi)
                                <p class="text-xs mt-2 text-blue-600 bg-blue-50 px-2 py-1 rounded inline-block">Resi: {{ $order->resi }}</p>
                            @endif

                            <div class="mt-3">
                                @php
                                    $statusBadge = match($order->status) {
                                    'Menunggu Pembayaran' => ['label' => '⏳ Menunggu Pembayaran', 'color' => 'text-yellow-700 bg-yellow-100'],
                                    'Diproses' => ['label' => '🔧 Diproses', 'color' => 'text-blue-700 bg-blue-100'],
                                    'Dikirim' => ['label' => '🚚 Dikirim', 'color' => 'text-purple-700 bg-purple-100'],
                                    'Selesai' => ['label' => '✅ Selesai', 'color' => 'text-green-700 bg-green-100'],
                                    'Dibatalkan' => ['label' => '❌ Dibatalkan', 'color' => 'text-gray-600 bg-gray-200'],
                                    default => ['label' => $order->status, 'color' => 'text-gray-700 bg-gray-100'],
                                    };
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $statusBadge['color'] }}">
                                    {{ $statusBadge['label'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Detail Pesanan -->
                        <div class="md:w-2/3 md:pl-6">
                            <p class="font-semibold mb-2 text-gray-800">Detail Pesanan:</p>
                            <ul class="text-sm space-y-1">
                                    @php $total = 0; @endphp
                                    @foreach($order->items as $item)
                                        @php 
                                            $sub = $item->price * $item->quantity;
                                            $total += $sub;
                                        @endphp
                                    <li>🍽 {{ $item->quantity }} x {{ $item->menu->name }} 
                                        <span class="text-gray-500">(Rp {{ number_format($sub, 0, ',', '.') }})</span>
                                    </li>
                                @endforeach
                            </ul>
                            <p class="text-right text-base font-bold text-gray-800 mt-3">
                                Total: Rp {{ number_format($total, 0, ',', '.') }}
                            </p>

                            <!-- Tombol Aksi -->
                            <div class="mt-4 space-y-3">

                            <!-- Konfirmasi pesanan diterima -->
                                @if($order->status === 'Dikirim')
                                    @if($order->pembayaran === 'COD' && !$order->bukti_pembayaran)
                                        <p class="text-red-600 text-sm font-semibold">
                                            ⚠️ Silakan upload bukti pembayaran terlebih dahulu untuk konfirmasi pesanan.
                                        </p>
                                    @else
                                        <form action="{{ route('orders.konfirmasiSelesai', $order->id) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa pesanan sudah diterima?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-sm px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow">
                                                ✅ Pesanan Diterima
                                            </button>
                                        </form>
                                    @endif
                                @endif

                                <!-- Tombol Struk (jika status selesai) -->
                                @if($order->status === 'Selesai')
                                    <button type="button"
                                        data-modal-target="modalStruk{{ $order->id }}"
                                        data-modal-toggle="modalStruk{{ $order->id }}"
                                        class="text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
                                        🧾 Lihat Struk
                                    </button>
                                    <x-order-struk-modal :order="$order" />
                                @endif

                                 <!-- COD - Upload bukti saat Dikirim  -->
                                @if($order->pembayaran === 'COD' && $order->status === 'Dikirim')
                                    @if(!$order->bukti_pembayaran)
                                        <form action="{{ route('orders.uploadBukti', $order->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label class="block mb-1 text-sm font-medium">Upload Bukti Pembayaran (COD):</label>
                                            <input type="file" name="bukti" accept="image/*" required class="block w-full text-sm text-gray-700 file:bg-green-100 file:text-green-800 file:rounded file:px-3 file:py-1 hover:file:bg-green-200"/>
                                            <button type="submit" class="mt-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm rounded">Kirim Bukti</button>
                                        </form>
                                    @else
                                        <p class="text-green-700 font-medium mt-2">✅ Bukti pembayaran sudah dikirim.</p>
                                    @endif
                                @endif

                               <!-- Transfer - Menunggu pembayaran  -->
                                @if($order->status === 'Menunggu Pembayaran' && $order->pembayaran !== 'COD')
                                    @if($order->bukti_pembayaran)
                                        <p class="mt-2 text-green-600 font-medium flex items-center gap-2">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Bukti pembayaran sudah dikirim.
                                        </p>
                                    @else
                                        <form action="{{ route('orders.uploadBukti', $order->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label class="block mb-1 text-sm font-medium">Upload Bukti Pembayaran:</label>
                                            <input type="file" name="bukti" accept="image/*" required class="block w-full text-sm text-gray-700 file:bg-yellow-100 file:text-yellow-800 file:rounded file:px-3 file:py-1 hover:file:bg-yellow-200"/>
                                            <button type="submit" class="mt-2 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded">Kirim Bukti</button>
                                        </form>

                                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Batalkan pesanan ini?');" class="mt-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded">
                                                Batalkan Pesanan
                                            </button>
                                        </form>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 text-center">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    <a href="https://wa.me/6289623255564?text=Halo%20admin,%20saya%20ingin%20bertanya%20tentang%20produk%20Anda." target="_blank"
   class="fixed bottom-20 right-5 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg z-50">
    <!-- Icon WhatsApp -->
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path
            d="M20.52 3.48A11.89 11.89 0 0012 0C5.37 0 0 5.37 0 12a11.86 11.86 0 001.7 6.1L0 24l6.32-1.66A11.93 11.93 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.2-3.48-8.52zM12 21.6a9.6 9.6 0 01-4.91-1.34l-.35-.2-3.75.98 1-3.66-.23-.38A9.59 9.59 0 1121.6 12c0 5.29-4.31 9.6-9.6 9.6zm5.18-7.26l-1.48-.75c-.2-.1-.43-.17-.66-.09-.21.07-.33.25-.46.41l-.17.21c-.12.15-.27.16-.44.09-1.2-.5-2.1-1.35-2.67-2.51-.1-.21-.1-.39.05-.56.08-.1.19-.22.27-.33.08-.1.18-.22.2-.35.03-.13 0-.28-.06-.4l-.64-1.44c-.15-.33-.53-.5-.86-.39l-.35.1a2.43 2.43 0 00-1.7 2.27c0 .45.12.9.34 1.3 1.14 2.15 3 3.77 5.26 4.63.4.15.82.22 1.23.22.5 0 .99-.13 1.42-.38a2.3 2.3 0 001.06-1.33c.1-.34-.02-.71-.35-.87z" />
    </svg>
</a>


    <x-footer />
</body>
</html>
