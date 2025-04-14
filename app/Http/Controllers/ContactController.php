<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    // Menampilkan halaman kontak
    public function index()
    {
        return view('contact');
    }

    // Memproses form kontak
    public function send(Request $request)
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Kirim email ke admin
        Mail::raw($request->message, function ($message) use ($request) {
            $message->to('support@kulinersumbar.com')
                    ->subject('Pesan dari ' . $request->name)
                    ->from($request->email);
        });

        // Mengirimkan pesan sukses dan mengarahkan kembali ke halaman kontak
        return redirect()->route('contact.index')->with('success', 'Pesan Anda telah dikirim!');
    }
}
