<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class CartController extends Controller
{
    //Tampilkan Halaman Keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('pages.cart', ['cartItems' => $cart]);
    }

    // Tambah item ke keranjang
    public function add(Request $request)
    {
        $id = $request->input('id');

        $item = [
            'id'       => $id,
            'name'     => $request->input('name'),
            'price'    => $request->input('price'),
            'quantity' => 1,
        ];

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = $item;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item berhasil ditambahkan ke keranjang!');
    }

    // Hapus item dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus!');
        }

        return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan!');
    }

    
    // Tampilkan form checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('pages.checkout', ['cart' => $cart]);
    }

    // Proses checkout: generate resi dan kosongkan keranjang
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
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $resi = Str::upper(Str::random(10));
        session()->put('order_resi', $resi);
        session()->put('order_data', array_merge($data, ['cart' => $cart]));

        session()->forget('cart');

        return redirect()->route('checkout.success');
    }

    // Halaman sukses checkout
    public function success()
    {
        $resi = session()->get('order_resi');
        $order = session()->get('order_data', []);
        return view('pages.checkout-success', compact('resi', 'order'));
    }
}