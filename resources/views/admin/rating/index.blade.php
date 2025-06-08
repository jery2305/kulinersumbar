@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold">Daftar Rating</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Dashboard
        </a>
    </div>

    <a href="{{ route('admin.rating.create') }}" class="btn btn-primary mb-3">+ Tambah Rating</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Menu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ratings as $rating)
                <tr>
                    <td>{{ $rating->id }}</td>
                    <td>{{ $rating->rating }}</td>
                    <td>{{ $rating->review }}</td>
                    <td>{{ $rating->menu->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.rating.edit', $rating) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                        <form action="{{ route('admin.rating.destroy', $rating) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus rating ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data rating.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
