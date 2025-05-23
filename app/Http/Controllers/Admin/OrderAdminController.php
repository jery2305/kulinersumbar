<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function form($id = null)
    {
        $order = $id ? Order::findOrFail($id) : null;
        return view('admin.order.create-edit', compact('order'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'pembayaran' => 'required|string',
            'status' => 'required|string',
            'resi' => 'nullable|string',
            'total' => 'required|numeric',
        ]);

        Order::create($data);

        return redirect()->route('admin.order.index')->with('success', 'Order berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $data = $request->validate([
            'user_id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'pembayaran' => 'required|string',
            'status' => 'required|string',
            'resi' => 'nullable|string',
            'total' => 'required|numeric',
        ]);

        $order->update($data);

        return redirect()->route('admin.order.index')->with('success', 'Order berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.order.index')->with('success', 'Order berhasil dihapus.');
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
