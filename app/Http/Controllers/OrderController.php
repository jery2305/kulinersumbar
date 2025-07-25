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

        // Ambil data menu dari database
        $menu = Menu::where('slug', $request->menu)->firstOrFail();

        $item = [
            'name' => $menu->name,
            'price' => $menu->price,
            'quantity' => $request->jumlah,
            'note' => $request->catatan,
            'menu_id' => $menu->id
        ];

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

    // Menampilkan histori pesanan
    public function history() 
    {
            $orders = Order::where('user_id', auth()->id())
            ->with('items.menu')
            ->orderBy('created_at', 'desc') // <-- pastikan ada ini
            ->paginate(10);
            
            // Hitung total untuk setiap order
            foreach ($orders as $order) {
                $order->total_price = $order->items->sum(function ($item) {
                    return $item->price * $item->quantity;  // Menghitung harga total item
                });
            }

            // Kirim data orders ke tampilan
            return view('pages.history', compact('orders'));
    }

    //Input Upload Bukti Foto
   public function uploadBukti(Request $request, $id)
    {
            $request->validate([
                'bukti' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            ]);

            $order = Order::findOrFail($id);

            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');

                // Simpan dengan nama asli
                $filename = $file->getClientOriginalName();

                // Pindahkan ke folder public/img
                $path = $file->move(public_path('img'), $filename);

                // Simpan path relatif ke database
                $order->bukti_pembayaran = 'img/' . $filename;
                $order->save();
            }

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah.');
    }

    // Batalkan Pesanan
    public function cancel(Order $order)
    {
        if ($order->status !== 'Menunggu Pembayaran') {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        $order->status = 'Dibatalkan';
        $order->save();

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // Konfirmasi Pemesanan
    public function konfirmasiSelesai($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'Dikirim') {
            $order->status = 'Selesai';
            $order->save();

            return back()->with('success', 'Pesanan berhasil dikonfirmasi sebagai selesai.');
        }

        return back()->with('error', 'Status pesanan tidak valid untuk dikonfirmasi.');
    }
}
