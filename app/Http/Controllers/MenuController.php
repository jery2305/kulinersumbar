<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Rating;
use App\Models\Order;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $menus = Menu::with(['ratings.user'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        $completedMenuIds = [];

        if (auth()->check()) {
            $completedMenuIds = Order::where('user_id', auth()->id())
                ->where('status', 'selesai')
                ->with('items')
                ->get()
                ->flatMap(fn ($order) => $order->items)
                ->pluck('menu_id')
                ->unique()
                ->toArray();
        }

        return view('pages.menu', compact('menus', 'completedMenuIds'));
    }

    public function pesan(Request $request)
    {
        return back()->with('success', "Pesanan untuk {$request->menu} berhasil dibuat!");
    }

    public function addReview(Request $request, $menuId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:4',
        ]);

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
        // HANYA ambil rating >= 3
        $menu = Menu::with(['ratings' => function ($query) {
            $query->where('rating', '>=', 3)->with('user');
        }])->findOrFail($id);

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
