<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Histori Pemesanan - Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <x-navbar />

    <div class="max-w-4xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Histori Pemesanannn</h1>

        @if($orders->isEmpty())
            <p class="text-center text-gray-600">Anda belum melakukan pemesanannnn.</p>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-lg font-semibold">Resi: {{ $order->resi }}</p>
                <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
            <p class="text-sm text-gray-600">{{ strtolower($order->status) }}</p>
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
                                    <li>{{ $item->quantity }} x {{ $item->menu }} (Rp {{ number_format($sub, 0, ',', '.') }})</li>
                                @endforeach
                            </ul>
                            <p class="text-right font-semibold mt-3">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
                        </div>
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
