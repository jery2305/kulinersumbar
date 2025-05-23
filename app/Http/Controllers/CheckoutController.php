<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'nama'       => 'required|string',
            'alamat'     => 'required|string',
            'telepon'    => 'required|string',
            'pembayaran' => 'required|string',
        ]);

        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Generate resi
        $resi = strtoupper(Str::random(10));

        // Simpan order ke database
        $order = new Order();
        $order->user_id = auth()->id();
        $order->nama = $data['nama'];
        $order->alamat = $data['alamat'];
        $order->telepon = $data['telepon'];
        $order->pembayaran = $data['pembayaran'];
        $order->resi = $resi;
        $order->total = $total;
        $order->status = 'Menunggu Pembayaran';
        $order->save();

        // Simpan item ke order_items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id'   => $item['id'],      // ini penting
                'menu_name' => $item['name'],
                'price'    => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        // Tampilkan halaman sukses
        return view('pages.checkout-success', [
            'order' => [
                'nama'       => $data['nama'],
                'alamat'     => $data['alamat'],
                'telepon'    => $data['telepon'],
                'pembayaran' => $data['pembayaran'],
                'cart'       => $cart,
                'total'      => $total,
            ],
            'resi' => $resi,
        ]);
    }
}
