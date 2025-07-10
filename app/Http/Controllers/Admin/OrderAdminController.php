<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function form($id = null)
    {
        $order = $id ? Order::findOrFail($id) : null;
        return view('admin.order.create-edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        // Cek status order, hanya izinkan jika "menunggu pembayaran" atau "diproses"
        if (!in_array(strtolower($order->status), ['menunggu pembayaran', 'diproses'])) {
            return redirect()->route('admin.order.index')->with('error', 'Alamat dan Telepon hanya bisa diedit saat status Menunggu Pembayaran atau Diproses.');
        }
        
        $validated = $request->validate([
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
        ]);

        // Debug dulu kalau perlu
        // dd($validated);

        // Simpan manual
        $order->alamat = $validated['alamat'];
        $order->telepon = $validated['telepon'];
        $order->save();

        return redirect()->route('admin.order.index')->with('success', 'Alamat dan Telepon berhasil diperbarui.');
    }

   public function confirm(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $newStatus = $request->input('new_status');

        $validTransitions = [
            'menunggu pembayaran' => ['diproses', 'dikirim', 'selesai'],
            'diproses' => ['dikirim', 'selesai'],
            'dikirim' => ['selesai'],
        ];

        $currentStatus = strtolower($order->status);

        if (isset($validTransitions[$currentStatus]) && in_array($newStatus, $validTransitions[$currentStatus])) {
            $order->status = $newStatus;
            $order->save();
            return redirect()->route('admin.order.index')->with('success', 'Status order berhasil diperbarui.');
        }

        return redirect()->route('admin.order.index')->with('error', 'Transisi status tidak valid.');
    }
}
