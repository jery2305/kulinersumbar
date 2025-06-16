<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderItemAdminController extends Controller
{
   public function index(Request $request)
    {
        $query = OrderItem::with(['order', 'menu']);

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $orderItems = $query->latest()->paginate(10);

        return view('admin.orderitem.index', compact('orderItems'));
    }

    public function form($id = null, $orderId = null)
    {
        $menus = Menu::all();
        $orderItem = null;

        if ($id) {
            $orderItem = OrderItem::findOrFail($id);
            $orderId = $orderItem->order_id;
        }

        return view('admin.orderitem.create-edit', compact('orderItem', 'menus', 'orderId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $menu = Menu::findOrFail($validated['menu_id']);

        OrderItem::create([
            'order_id'   => $validated['order_id'],
            'menu_id'    => $menu->id,
            'menu_name'  => $menu->name, // Disimpan agar tetap tampil meski menu diubah
            'quantity'   => $validated['quantity'],
            'price'      => $validated['price'],
        ]);

        return redirect()->route('admin.orderitem.index')
                         ->with('success', 'Order Item berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderItem = OrderItem::findOrFail($id);
        $menu = Menu::findOrFail($validated['menu_id']);

        $orderItem->update([
            'order_id'   => $validated['order_id'],
            'menu_id'    => $menu->id,
            'menu_name'  => $menu->name,
            'quantity'   => $validated['quantity'],
            'price'      => $validated['price'],
        ]);

        return redirect()->route('admin.orderitem.index')
                         ->with('success', 'Order Item berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return redirect()->route('admin.orderitem.index')
                         ->with('success', 'Order Item berhasil dihapus.');
    }
}
