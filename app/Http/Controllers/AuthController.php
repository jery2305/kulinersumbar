<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi data login
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Cek role pengguna setelah login
            $user = Auth::user();

            // Jika role admin, arahkan ke dashboard admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika role bukan admin, arahkan ke home page
            return redirect()->route('home');
        }

        // Jika login gagal, beri pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}


