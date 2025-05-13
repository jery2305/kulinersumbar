<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <x-navbar />

    <!-- Checkout Content -->
    <div class="max-w-3xl mx-auto mt-24 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Checkout Pesanan</h2>

        <form action="{{ route('process-checkout') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkapp</label>
                <input type="text" name="nama" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                <textarea name="alamat" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="text" name="telepon" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select name="pembayaran" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD">Cash on Delivery (COD)</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Ringkasan Pesanann</h3>
                <ul class="space-y-2">
                    @foreach($cart as $item)
                    <li class="flex justify-between text-sm text-gray-700">
                        <span>{{ $item['quantity'] }}x {{ $item['name'] }}</span>
                        <span>Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">Konfirmasi Pesanan</button>
        </form>
    </div>
</body>
</html>