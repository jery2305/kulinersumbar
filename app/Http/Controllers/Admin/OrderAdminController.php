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
            'bukti_pembayaran' => 'nullable|image|max:2048', // max 2MB
        ]);

    if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/bukti_pembayaran', $filename);
            $validated['bukti_pembayaran'] = $filename;
        }

        Order::create($validated);

        return redirect()->route('admin.order.index')->with('success', 'Order berhasil ditambahkan.');
    }

   public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'pembayaran' => 'required|string',
            'status' => 'required|string',
            'resi' => 'nullable|string',
            'total' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus file lama jika ada
            if ($order->bukti_pembayaran && \Storage::exists('public/bukti_pembayaran/' . $order->bukti_pembayaran)) {
                \Storage::delete('public/bukti_pembayaran/' . $order->bukti_pembayaran);
            }

            $file = $request->file('bukti_pembayaran');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/bukti_pembayaran', $filename);
            $validated['bukti_pembayaran'] = $filename;
        }

        $order->update($validated);

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
