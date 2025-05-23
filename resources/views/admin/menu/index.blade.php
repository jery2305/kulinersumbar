@extends('layouts.admin')

@section('content')
<div class="container">
     <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold">Daftar Menu</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Dashboard
        </a>
    </div>

    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary mb-3">+ Tambah Menu</a>

    <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $index => $menu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img src="{{ asset('img/'.$menu->image) }}" alt="{{ $menu->name }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
                    </td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ 'Rp '.number_format($menu->price, 0, ',', '.') }}</td>
                    <td>{{ Str::limit($menu->description, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                        <form action="{{ route('admin.menu.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus menu ini?')">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data menu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
