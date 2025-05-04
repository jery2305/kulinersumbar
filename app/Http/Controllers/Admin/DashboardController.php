<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data dummy, nanti bisa ganti dari database
        $totalOrders = 120;
        $totalUsers = 45;

        return view('admin.dashboard', compact('totalOrders', 'totalUsers'));
    }
}
