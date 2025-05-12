<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; // Pastikan model Order sudah ada

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

        $order = new Order();
        $order->user_id = auth()->id(); // Ambil ID user yang sedang login
        $order->total = $request->total; // Anda bisa menyimpan total harga di sini
        $order->status = 'Menunggu Pembayaran'; // Misalnya status awal
        $order->save(); // Simpan data pesanan

        // Mengosongkan keranjang setelah checkout
        session()->forget('cart');

        return redirect()->route('cart')->with('message', 'Pesanan Anda berhasil diproses!');
    }

    // Menampilkan histori pesanan
    public function history() 
    {
        $user = auth()->user();
        // Mengambil pesanan dan relasi items, paginasi 10
        $orders = $user->orders()->with('items')->paginate(10);

        // Hitung total untuk setiap order
        foreach ($orders as $order) {
            $order->total_price = $order->items->sum(function ($item) {
                return $item->price * $item->quantity;  // Menghitung harga total item
            });
        }

        // Kirim data orders ke tampilan
        return view('pages.history', compact('orders'));
    }

}
