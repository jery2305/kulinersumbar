<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Menu;
use Illuminate\Http\Request;

class RatingAdminController extends Controller
{
    public function index()
    {
        $ratings = Rating::orderBy('rating', 'desc')->get();
        return view('admin.rating.index', compact('ratings'));
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();
        return redirect()->route('admin.rating.index')->with('success', 'Rating berhasil dihapus.');
    }
}
