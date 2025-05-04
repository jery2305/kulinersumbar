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

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Generate resi (misalnya pakai UUID)
        $resi = strtoupper(Str::random(10));

        // Simpan pesanan (kalau pakai database, bisa disimpan di sini)

        // Kosongkan keranjang
        session()->forget('cart');

        // Tampilkan halaman sukses
        return view('pages.checkout-success', [
            'nama'       => $data['nama'],
            'alamat'     => $data['alamat'],
            'telepon'    => $data['telepon'],
            'pembayaran' => $data['pembayaran'],
            'resi'       => $resi,
        ]);
    }
}
