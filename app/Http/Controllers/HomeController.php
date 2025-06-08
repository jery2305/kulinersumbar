<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 menu dengan rating rata-rata tertinggi
        $recommendedMenus = Menu::withAvg('ratings', 'rating')
            ->havingNotNull('ratings_avg_rating')   // hanya yang punya rating
            ->orderByDesc('ratings_avg_rating')  // Harus sama aliasnya dengan withAvg
            ->take(3)
            ->get();

        // Kirim data ke view home
        return view('pages.home', compact('recommendedMenus'));
    }
}
