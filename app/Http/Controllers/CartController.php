<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;  // Pastikan ini ada!

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
    
        // Simpan ke tabel orders
        $order = Order::create([
            'user_id'    => Auth::id(), // pastikan user login
            'nama'       => $data['nama'],
            'alamat'     => $data['alamat'],
            'telepon'    => $data['telepon'],
            'pembayaran' => $data['pembayaran'],
            'resi'       => $resi,
        ]);
    
        // Simpan detail item ke tabel order_items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu'     => $item['name'],
                'price'    => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }
    
        session()->forget('cart');
    
        return redirect()->route('checkout.success')->with('resi', $resi);
    }

    // Halaman sukses checkout
    public function success()
    {
        // Mendapatkan nomor resi dan data pesanan dari session
        $resi = session()->get('order_resi');
        $order = session()->get('order_data', []);
    
        // Pastikan data pesanan ada dan lengkap
        if (empty($order)) {
            return redirect()->route('cart.index')->with('error', 'Data pesanan tidak ditemukan.');
        }
    
        return view('pages.checkout-success', compact('resi', 'order'));
    }
    

    // Update jumlah item di keranjang
    public function update(Request $request, $id)
    {
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $id = (string) $id; // normalize ke string
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = $request->input('quantity');
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Jumlah item berhasil diperbarui!');
    }

    return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan di keranjang.');
    }

}