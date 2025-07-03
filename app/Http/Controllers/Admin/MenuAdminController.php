<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $menus = Menu::when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get();

        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $imageFiles = $this->getAvailableImages();
        return view('admin.menu.create-edit', compact('imageFiles'));
    }

    public function edit(Menu $menu)
    {
        $imageFiles = $this->getAvailableImages();
        return view('admin.menu.create-edit', compact('menu', 'imageFiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('img'), $filename);
        }

        Menu::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $filename,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = $request->only('name', 'price', 'description');

        if ($request->hasFile('image')) {
            if ($menu->image && file_exists(public_path('img/' . $menu->image))) {
                unlink(public_path('img/' . $menu->image));
            }

            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('img'), $filename);
            $data['image'] = $filename;
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image && file_exists(public_path('img/' . $menu->image))) {
            unlink(public_path('img/' . $menu->image));
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus.');
    }

    public function getAvailableImages()
    {
        $files = scandir(public_path('img'));
        return array_filter($files, function ($file) {
            return preg_match('/\.(jpg|jpeg|png)$/i', $file);
        });
    }
}
