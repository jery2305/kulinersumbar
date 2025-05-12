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
        $menus = Menu::with('ratings')->get(); // Eager load rating
        return view('pages.menu', compact('menus'));
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
            'review' => 'nullable|string|max:255',
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
