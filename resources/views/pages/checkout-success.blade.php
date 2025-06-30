<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Sukses - Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <x-navbar />

    <div class="max-w-3xl mx-auto mt-24 p-6 bg-white shadow-lg rounded-lg text-center">
        <i class="fas fa-check-circle text-green-600 text-4xl mb-4"></i>
        <h2 class="text-3xl font-bold mb-4 text-green-600 animate-pulse">Pesanan Berhasil!</h2>
        <p class="mb-2 text-gray-700">Terima kasih, {{ $order['nama'] }}. Pesanan Anda telah kami terima.</p>
        <p class="mb-4 text-gray-700">Metode Pembayaran: {{ $order['pembayaran'] }}</p>

        <div class="bg-gray-50 p-4 rounded-lg mb-4">
            <h3 class="text-lg font-semibold mb-2 text-gray-800">Ringkasan Pesanan</h3>
            <ul class="space-y-2">
                @foreach($order['cart'] as $item)
                    <li class="flex justify-between text-sm text-gray-700">
                        <span>{{ $item['quantity'] }}x {{ $item['name'] }}</span>
                        <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            <p class="mt-4 font-semibold text-gray-800">Total Pembayaran: Rp {{ number_format(array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $order['cart'])), 0, ',', '.') }}</p>
        </div>

        <div class="flex justify-center space-x-4 mt-4">
            <a href="{{ route('orders.history') }}" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Lihat Riwayat Pesanan
            </a>
            <a href="{{ route('menu') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Kembali ke Menu
            </a>
        </div>
    </div>

</body>
</html>
