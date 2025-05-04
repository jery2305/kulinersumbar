<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Menampilkan form pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani pendaftaran pengguna
    public function register(Request $request)
    {
        // Validasi data pengguna
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role'     => 'required|in:user,admin',           // <-- tambahkan ini
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mendaftar pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // tambahkan ini
        ]);        

        // Redirect ke halaman login atau halaman yang diinginkan setelah registrasi
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
