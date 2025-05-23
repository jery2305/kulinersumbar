@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold">{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu' }}</h1>

    <form action="{{ isset($menu) ? route('admin.menu.update', $menu) : route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($menu)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Nama Menu</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $menu->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $menu->price ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description', $menu->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control">
            @if(isset($menu) && $menu->image)
                <img src="{{ asset('img/'.$menu->image) }}" width="150" class="mt-2" alt="{{ $menu->name }}">
            @endif
        </div>


        <button type="submit" class="btn btn-success">{{ isset($menu) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endsection
