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
        $ratings = Rating::with('menu')->latest()->get();
        return view('admin.rating.index', compact('ratings'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.rating.create-edit', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
            'menu_id' => 'required|exists:menus,id',
        ]);

        Rating::create($request->only('rating', 'review', 'menu_id'));

        return redirect()->route('admin.rating.index')->with('success', 'Rating berhasil ditambahkan.');
    }

    public function edit(Rating $rating)
    {
        $menus = Menu::all();
        return view('admin.rating.create-edit', compact('rating', 'menus'));
    }

    public function update(Request $request, Rating $rating)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
            'menu_id' => 'required|exists:menus,id',
        ]);

        $rating->update($request->only('rating', 'review', 'menu_id'));

        return redirect()->route('admin.rating.index')->with('success', 'Rating berhasil diperbarui.');
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();
        return redirect()->route('admin.rating.index')->with('success', 'Rating berhasil dihapus.');
    }
}
