<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <x-navbar />

    <!-- Checkout Content -->
    <div class="max-w-3xl mx-auto mt-24 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Checkout Pesanan</h2>

        @php
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        @endphp

        <form action="{{ route('process-checkout') }}" method="POST" class="space-y-4">
            @csrf

            @auth
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ Auth::user()->name }}" readonly
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100 cursor-not-allowed">
                </div>
            @else
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                </div>
            @endauth

            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                <textarea name="alamat" required
                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="text" name="telepon" required
                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select name="pembayaran" id="metodePembayaran" required
                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2"
                    onchange="tampilkanQRIS()">
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD">Cash on Delivery (COD)</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="QRIS">QRIS</option>
                </select>
            </div>

            <div id="qrisContainer" class="mt-4 hidden text-center">
                <label class="block text-sm font-medium text-gray-700 mb-2">Scan QRIS di bawah ini:</label>
                <img src="img/qris.jpg" alt="QRIS" class="w-48 my-4 mx-auto">
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Ringkasan Pesanan</h3>
                <ul class="space-y-2">
                    @foreach($cart as $item)
                        <li class="flex justify-between text-sm text-gray-700">
                            <span>{{ $item['quantity'] }}x {{ $item['name'] }}</span>
                            <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="text-right font-bold mt-2">
                    Total: Rp {{ number_format($total, 0, ',', '.') }}
                </p>
            </div>

            <input type="hidden" name="total" value="{{ $total }}">

            <button type="submit"
                class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                Konfirmasi Pesanan
            </button>
        </form>
    </div>

    <!-- QRIS Script -->
    <script>
        function tampilkanQRIS() {
            const select = document.getElementById('metodePembayaran');
            const qrisDiv = document.getElementById('qrisContainer');
            if (select.value === 'QRIS') {
                qrisDiv.classList.remove('hidden');
            } else {
                qrisDiv.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
