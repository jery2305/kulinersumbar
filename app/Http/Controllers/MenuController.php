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
        $menus = Menu::with('ratings')->get(); // Tetap load ratings

        $completedMenuIds = [];

        if (auth()->check()) {
            $completedMenuIds = Order::where('user_id', auth()->id())
                ->where('status', 'selesai')
                ->with('items') // relasi ke order_items
                ->get()
                ->flatMap(function ($order) {
                    return $order->items;
                })
                ->pluck('menu_id')
                ->unique()
                ->toArray();
        }

        return view('pages.menu', compact('menus', 'completedMenuIds'));
    }


    public function pesan(Request $request)
    {
        $namaMenu = $request->input('menu');
        $jumlah = $request->input('jumlah');
        $catatan = $request->input('catatan');

        // Contoh: simpan ke database (nanti kalau ada model & tabel)
        // Pesanan::create([
        //     'menu' => $namaMenu,
        //     'jumlah' => $jumlah,
        //     'catatan' => $catatan,
        // ]);

        return back()->with('success', "Pesanan untuk $namaMenu berhasil dibuat!");
    }

     // Menambahkan rating dan ulasan
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
        $hasOrdered = Order::where('user_id', auth()->id())
            ->where('menu_id', $menuId)
            ->exists();

        //if (!$hasOrdered) {
          //  return back()->with('error', 'Anda harus memesan menu ini terlebih dahulu untuk memberi ulasan.');
        //}

        Rating::create([
            'menu_id' => $menuId,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()
            ->with('success_menu_id', $menuId)
            ->with('success', 'Ulasan berhasil dikirim!');
    }

}
