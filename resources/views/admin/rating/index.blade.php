@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Daftar Rating</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Dashboard
        </a>
    </div>

    <!-- Search Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.rating.index') }}">
                <div class="row align-items-end">
                    <div class="col-md-6">
                     
                        <input
                            type="text"
                            name="search"
                            id="search"
                            value="{{ request('search') }}"
                            placeholder="Masukkan nama menu..."
                            class="form-control"
                        />
                    </div>
                    <div class="col-md-3 mt-3 mt-md-0">
                        <button class="btn btn-primary w-100" type="submit">Cari</button>
                    </div>
                    <div class="col-md-3 mt-3 mt-md-0">
                        <a href="{{ route('admin.rating.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel -->
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
                        <form action="{{ route('admin.rating.destroy', $rating) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus rating ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data rating.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
