<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang - Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-relaxed tracking-wide">

  <!-- Navbar -->
  <x-navbar />

  <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Keranjang Belanja</h1>
        @if(is_array($cartItems) && count($cartItems) > 0)
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Nama Menu</th>
                        <th class="py-3 px-6 text-center">Jumlah</th>
                        <th class="py-3 px-6 text-center">Harga</th>
                        <th class="py-3 px-6 text-center">Total</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @php $grandTotal = 0; @endphp
                    @foreach($cartItems as $id => $item)
                        @php $itemTotal = $item['price'] * $item['quantity']; $grandTotal += $itemTotal; @endphp
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $item['name'] }}</td>
                            <td class="py-3 px-6 text-center">{{ $item['quantity'] }}</td>
                            <td class="py-3 px-6 text-center">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-center">Rp {{ number_format($itemTotal, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-center">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right mt-6">
                <p class="text-lg font-bold">Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
                <a href="{{ route('checkout') }}" class="inline-block mt-4 bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Checkout</a>
            </div>
        @else
            <p class="text-center text-gray-600">Keranjang kamu kosong.</p>
            <div class="text-center mt-6">
                <a href="/menu" class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Kembali ke Menu</a>
            </div>
        @endif
    </div>
</body>
</html>