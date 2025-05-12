<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        $data = $request->validate([
            'nama'       => 'required|string',
            'alamat'     => 'required|string',
            'telepon'    => 'required|string',
            'pembayaran' => 'required|string',
        ]);

        // Ambil keranjang belanja dari session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

       // Hitung total harga pesanan
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity']; // Total per item
        }
        
        // Generate resi (misalnya pakai UUID atau random string)
        $resi = strtoupper(Str::random(10));

        // Kosongkan keranjang setelah checkout
        session()->forget('cart');

        // Tampilkan halaman sukses dan kirim data ke tampilan
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
