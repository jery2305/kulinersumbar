<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rating;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data asli dari database
        $userCount = User::count();
        $menuCount = Menu::count();
        $orderCount = Order::count();
        $ratingCount = Rating::count();
        $orderItemCount = OrderItem::count();

        return view('admin.dashboard', compact(
            'userCount',
            'menuCount',
            'orderCount',
            'ratingCount',
            'orderItemCount'
        ));
    }

}
