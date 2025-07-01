<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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
     <div x-data="{
    metode: '',
    banks: {
        mandiri: {
            name: 'Bank Mandiri',
            account: '1370030301119',
            owner: 'Sayid Munawar',
            branch: 'Yogyakarta Kotagede',
        },
        bca: {
            name: 'BCA',
            account: '1234567890',
            owner: 'Andi Saputra',
            branch: 'BCA Sudirman',
        },
        bri: {
            name: 'BANK BRI',
            account: '7894561230',
            owner: 'Dewi Lestari',
            branch: 'BRI Padang Barat',
        },
        ewallet: {
            provider: 'OVO / Dana / GoPay',
            number: '0812-3456-7890',
        }
    }
}">
    <label class="block font-semibold mb-2">Metode Pembayaran</label>
    <select name="pembayaran" x-model="metode" required class="w-full border rounded p-2">
        <option value="">-- Pilih Metode Pembayaran --</option>
        <option value="mandiri">Transfer Bank Mandiri</option>
        <option value="bca">Transfer BCA</option>
        <option value="bri">Transfer BRI</option>
        <option value="cod">Cash on Delivery (COD)</option>
        <option value="ewallet">E-Wallet</option>
    </select>

    <!-- Info Bank Transfer -->
    <template x-if="banks[metode] && metode !== 'ewallet' && metode !== 'cod'">
        <div class="mt-4 p-4 border rounded bg-gray-100">
            <p class="font-bold" x-text="banks[metode].name"></p>
            <p>No. Rekening: <span class="font-semibold" x-text="banks[metode].account"></span></p>
            <p>a.n. <span x-text="banks[metode].owner"></span></p>
            <p>Cabang: <span x-text="banks[metode].branch"></span></p>
        </div>
    </template>

    <!-- Info E-Wallet -->
    <template x-if="metode === 'ewallet'">
        <div class="mt-4 p-4 border rounded bg-gray-100">
            <p class="font-bold">Pembayaran via E-Wallet</p>
            <p>Provider: <span x-text="banks.ewallet.provider"></span></p>
            <p>No. HP: <span x-text="banks.ewallet.number"></span></p>
        </div>
    </template>

    <!-- Info COD -->
    <template x-if="metode === 'cod'">
        <div class="mt-4 p-4 border rounded bg-green-100">
            <p class="font-bold text-green-700">Bayar di Tempat (COD)</p>
            <p>Pembayaran dilakukan saat pesanan sampai ke alamat tujuan.</p>
        </div>
    </template>
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
</body>
</html>
