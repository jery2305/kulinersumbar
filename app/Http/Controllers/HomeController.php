<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengarahkan ke view 'home'
        return view('pages.home');
    }
}
