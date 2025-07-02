<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Keranjang - Kuliner Sumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans leading-relaxed tracking-wide">

  <!-- Navbar -->
  <x-navbar />

  <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Keranjang Belanja</h1>

    @if(is_array($cartItems) && count($cartItems) > 0)
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
          <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-left">Menu</th>
              <th class="py-3 px-6 text-center">Jumlah</th>
              <th class="py-3 px-6 text-center">Harga</th>
              <th class="py-3 px-6 text-center">Total</th>
              <th class="py-3 px-6 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-gray-700 text-sm font-light">
            @php $grandTotal = 0; @endphp
            @foreach($cartItems as $id => $item)
              @php
                $itemTotal = $item['price'] * $item['quantity'];
                $grandTotal += $itemTotal;
              @endphp
              <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left flex items-center gap-4">
                    <img src="{{ asset('img/' . ($item['image'] ?? 'default.jpg')) }}" 
                      alt="{{ $item['name'] }}"
                      class="w-16 h-16 object-cover rounded shadow" />
                    <span>{{ $item['name'] }}</span>
                </td>

                <!-- FORM UPDATE JUMLAH -->
                <td class="py-3 px-6 text-center">
                  <form action="{{ route('cart.update', $id) }}" method="POST" x-data @change="$el.submit()">
                      @csrf
                      @method('PUT')
                      <input 
                          type="number" 
                          name="quantity" 
                          value="{{ $item['quantity'] }}" 
                          min="1"
                          class="w-16 text-center border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                  </form>
                </td>

                <td class="py-3 px-6 text-center">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                <td class="py-3 px-6 text-center">Rp {{ number_format($itemTotal, 0, ',', '.') }}</td>
                <td class="py-3 px-6 text-center">
                  <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button 
                      type="submit" 
                      onclick="return confirm('Apakah kamu yakin ingin menghapus item ini?')" 
                      class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                      Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="text-right mt-6">
        <p class="text-lg font-bold">Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>

        @auth
          <!-- Tombol checkout aktif jika sudah login -->
          <a href="{{ route('checkout') }}" class="inline-block mt-4 bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
            Checkout
          </a>
        @else
          <!-- Tombol checkout disabled jika belum login -->
          <button 
            class="inline-block mt-4 bg-gray-400 text-white px-6 py-2 rounded cursor-not-allowed"
            disabled
          >
            Checkout (Login dulu)
          </button>
          <p class="mt-2 text-red-600">
            Silakan <a href="{{ route('login') }}" class="underline">login</a> untuk melanjutkan pembelian.
          </p>
        @endauth
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
