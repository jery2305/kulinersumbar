@extends('layouts.admin')

@section('content')
<div class="container">
     <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold">Daftar Pengguna</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Dashboard
        </a>
    </div>

    <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">+ Tambah Pengguna</a>

    <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>••••••••</td> {{-- Demi keamanan, jangan tampilkan password asli --}}
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                        <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
