<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Rating;
use App\Models\Order;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with(['ratings.user'])->get(); // Load ratings beserta user-nya

        $completedMenuIds = [];

        if (auth()->check()) {
            $completedMenuIds = Order::where('user_id', auth()->id())
                ->where('status', 'selesai')
                ->with('items') // relasi ke order_items
                ->get()
                ->flatMap(fn($order) => $order->items)
                ->pluck('menu_id')
                ->unique()
                ->toArray();
        }

        return view('pages.menu', compact('menus', 'completedMenuIds'));
    }

    public function pesan(Request $request)
    {
        // Simpan logika pemesanan jika diperlukan
        return back()->with('success', "Pesanan untuk {$request->menu} berhasil dibuat!");
    }

    public function addReview(Request $request, $menuId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:4',
        ], [
            'rating.required' => 'Rating wajib diisi.',
            'review.required' => 'Ulasan tidak boleh kosong.',
            'review.min' => 'Ulasan minimal 4 karakter.',
        ]);

        // Cek apakah user sudah pernah memesan menu ini
        $hasOrdered = \App\Models\OrderItem::where('menu_id', $menuId)
            ->whereHas('order', function ($q) {
                $q->where('user_id', auth()->id())
                  ->where('status', 'selesai');
            })->exists();

        if (!$hasOrdered) {
            return back()->with('error', 'Anda harus memesan menu ini terlebih dahulu untuk memberi ulasan.');
        }

        Rating::create([
            'menu_id' => $menuId,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()
            ->with('success', 'Ulasan berhasil dikirim!')
            ->with('menu_id', $menuId);
    }

    public function reviewPage($id)
    {
        $menu = Menu::with(['ratings.user'])->findOrFail($id);
        
        $canReview = false;

        if (auth()->check()) {
            $canReview = \App\Models\OrderItem::where('menu_id', $menu->id)
                ->whereHas('order', function ($q) {
                    $q->where('user_id', auth()->id())
                      ->where('status', 'selesai');
                })->exists();
        }

        return view('pages.review-page', compact('menu', 'canReview'));
    }
}
