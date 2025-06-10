<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Histori Pemesanan - Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-50 font-sans">

    <x-navbar />

    <div class="max-w-4xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Histori Pemesanan</h1>

        @if($orders->isEmpty())
            <p class="text-center text-gray-600">Anda belum melakukan pemesanan.</p>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <div class="flex justify-between items-start">
                            <div>
                                @if(in_array($order->status, ['Diproses', 'Dikirim', 'Selesai']) && $order->resi)
                                    <div class="bg-gray-100 text-blue-800 px-4 py-2 rounded mb-2">
                                        <span class="font-semibold">Resi:</span> {{ $order->resi }}
                                    </div>
                                @endif
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>

                            @php
                                $statusBadge = match($order->status) {
                                    'Menunggu Pembayaran' => ['color' => 'bg-yellow-100 text-yellow-800', 'icon' => null],
                                    'Diproses' => ['color' => 'bg-blue-100 text-blue-800', 'icon' => null],
                                    'Dikirim' => ['color' => 'bg-purple-100 text-purple-800', 'icon' => null],
                                    'Selesai' => ['color' => 'bg-green-100 text-green-800', 'icon' => '✅'],
                                    default => ['color' => 'bg-gray-100 text-gray-800', 'icon' => null],
                                };
                            @endphp

                            <span class="text-sm px-3 py-1 rounded-full font-medium {{ $statusBadge['color'] }}">
                                @if ($statusBadge['icon']) {{ $statusBadge['icon'] }} @endif {{ $order->status }}
                            </span>
                        </div>

                        <div class="mt-4">
                            <p class="font-medium">Detail Pesanan:</p>
                            <ul class="list-disc list-inside text-sm mt-1">
                                @php $total = 0; @endphp
                                @foreach($order->items as $item)
                                    @php 
                                        $sub = $item->price * $item->quantity; 
                                        $total += $sub; 
                                    @endphp
                                    <li>{{ $item->quantity }} x {{ $item->menu->name }} (Rp {{ number_format($sub, 0, ',', '.') }})</li>
                                @endforeach
                            </ul>
                            <p class="text-right font-semibold mt-3">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
                        </div>

                        <!-- Form Upload Bukti Pembayaran  -->
                        @if($order->status === 'Menunggu Pembayaran')
                            @if($order->bukti_pembayaran)
                                <div class="mt-4 text-green-600 font-medium flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Bukti pembayaran telah dikirim.
                                </div>
                            @else
                                <form action="{{ route('orders.uploadBukti', $order->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                    @csrf
                                    <label for="bukti" class="block mb-2 font-medium text-gray-700">Upload Bukti Pembayaran:</label>
                                    <input type="file" name="bukti" id="bukti" accept="image/*" required class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-yellow-50 file:text-yellow-700
                                    hover:file:bg-yellow-100
                                    "/>
                                    <button type="submit" class="mt-3 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">Kirim Bukti</button>
                                </form>
                            @endif
                        @endif
                    </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="mt-6 text-center">
                {{ $orders->links() }}  <!-- Paginasi akan muncul jika $orders dipaginasi -->
            </div>
        @endif
    </div>

    <x-footer />

</body>
</html>
