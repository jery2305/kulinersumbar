<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('pages.menu');
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
}
