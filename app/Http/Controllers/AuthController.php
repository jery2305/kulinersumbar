<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login manual
     */
    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect sesuai role
            return $user->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('home');
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Logout pengguna
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect ke Google untuk login
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cari atau buat user baru
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'     => $googleUser->getName(),
                    'password' => bcrypt(str()->random(16)), // password random
                    'role'     => 'user', // default role
                ]
            );

            Auth::login($user);

            // Redirect sesuai role
            return $user->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors([
                'google_error' => 'Login Google gagal. Silakan coba lagi.'
            ]);
        }
    }
}
