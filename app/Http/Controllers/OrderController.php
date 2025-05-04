<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan keranjang
    public function index()
    {
        // Simulasi data keranjang sementara
        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('pages.cart', compact('cart', 'total'));
    }

    // Menambah item ke keranjang
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Simulasi data menu
        $menu = [
            'rendang' => ['name' => 'Rendang', 'price' => 25000],
            'sate_padang' => ['name' => 'Sate Padang', 'price' => 20000],
            'dendeng_balado' => ['name' => 'Dendeng Balado', 'price' => 30000],
        ];

        $item = $menu[$request->menu];
        $item['quantity'] = $request->jumlah;
        $item['note'] = $request->catatan;

        // Simpan ke keranjang
        $cart[] = $item;
        session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    // Menghapus item dari keranjang
    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->index]);

        session()->put('cart', array_values($cart));

        return redirect()->route('cart');
    }

    // Menampilkan halaman checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('pages.checkout', compact('cart'));
    }

    // Memproses checkout
    public function processCheckout(Request $request)
    {
        // Lakukan pemrosesan pemesanan seperti menyimpan ke database, dll.
        // Untuk sekarang, anggap pemesanan berhasil.

        session()->forget('cart'); // Mengosongkan keranjang setelah checkout

        return redirect()->route('cart')->with('message', 'Pesanan Anda berhasil diproses!');
    }

    public function history()
    {
       // Misalnya jika ingin menggunakan data yang tersimpan dalam sesi atau cara lain
        $user = auth()->user();
        $orders = $user->orders;  // Jika relasi 'orders' ada pada model User
        return view('pages.history', compact('orders'));
    }
}
