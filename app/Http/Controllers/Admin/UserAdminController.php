<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function destroy(User $user)
    {
        // Cegah agar user tidak bisa menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.user.index')
                ->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        try {
            $user->delete();
            return redirect()->route('admin.user.index')
                ->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.user.index')
                ->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }

}
