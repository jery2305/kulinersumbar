<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Menampilkan halaman kontak
    public function index()
    {
        return view('pages.contact');  // Sesuaikan dengan lokasi view kamu
    }

    // Menangani pengiriman form kontak
    public function send(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string|max:1000',
        ]);

        // Simpan data kontak ke database
        Contact::create([
            'nama'  => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
        ]);

        // Redirect balik dengan pesan sukses
        return back()->with('success', 'Pesan Anda berhasil dikirim. Terima kasih!');
    }
}
