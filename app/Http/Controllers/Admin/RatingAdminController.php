<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Rating::with('menu');

        if ($request->has('search') && $request->search) {
            $query->whereHas('menu', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $ratings = $query->orderBy('rating', 'desc')->get();

        return view('admin.rating.index', compact('ratings'));
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();
        return redirect()->route('admin.rating.index')->with('success', 'Rating berhasil dihapus.');
    }
}
