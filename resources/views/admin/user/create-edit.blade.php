@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold">{{ isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna' }}</h1>

    <form 
        action="{{ isset($user) ? route('admin.user.update', $user) : route('admin.user.store') }}" 
        method="POST">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" 
                value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" 
                value="{{ old('email', $user->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" 
                {{ isset($user) ? '' : 'required' }} placeholder="{{ isset($user) ? 'Biarkan kosong jika tidak diubah' : '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ (old('role', $user->role ?? '') == 'user') ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($user) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endsection
