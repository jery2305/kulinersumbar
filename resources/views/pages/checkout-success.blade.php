<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <x-navbar />

<div class="max-w-3xl mx-auto mt-24 p-6 bg-white shadow-lg rounded-lg text-center">
        <h2 class="text-3xl font-bold mb-4 text-green-600">Pesanan Berhasil!</h2>
        <p class="mb-2 text-gray-700">Terima kasih, {{ $order['nama'] }}. Pesanan Anda telah kami terima.</p>
        <p class="mb-2 text-gray-700">Nomor Resi: <span class="font-mono">{{ $resi }}</span></p>
        <p class="mb-4 text-gray-700">Metode Pembayaran: {{ $order['pembayaran'] }}</p>
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

