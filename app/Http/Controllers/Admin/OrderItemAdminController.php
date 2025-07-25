<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderItemAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderItem::with(['order', 'menu'])
            ->orderBy('created_at', 'desc'); // Menampilkan data terbaru terlebih dahulu

        // Filter input dari form
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $allItems = $query->get();
        $orderItems = $query->paginate(10);

        // Sinkronisasi grafik
        $perTanggal = collect(
            $allItems->groupBy(fn($item) => Carbon::parse($item->created_at)->format('Y-m-d'))
                ->map(fn($group, $key) => (object)[
                    'label' => $key,
                    'total' => $group->sum('quantity')
                ])
                ->values()
        );

        $perBulan = collect(
            $allItems->groupBy(fn($item) => Carbon::parse($item->created_at)->format('F Y'))
                ->map(fn($group, $key) => (object)[
                    'label' => $key,
                    'total' => $group->sum('quantity')
                ])
                ->values()
        );

        $perTahun = collect(
            $allItems->groupBy(fn($item) => Carbon::parse($item->created_at)->format('Y'))
                ->map(fn($group, $key) => (object)[
                    'label' => $key,
                    'total' => $group->sum('quantity')
                ])
                ->values()
        );

        return view('admin.orderitem.index', compact(
            'orderItems', 'allItems',
            'perTanggal', 'perBulan', 'perTahun'
        ));
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
            'menu_name'  => $menu->name,
            'quantity'   => $validated['quantity'],
            'price'      => $validated['price'],
        ]);

        return redirect()->route('admin.orderitem.index')->with('success', 'Order Item berhasil ditambahkan.');
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

        return redirect()->route('admin.orderitem.index')->with('success', 'Order Item berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return redirect()->route('admin.orderitem.index')->with('success', 'Order Item berhasil dihapus.');
    }
}
