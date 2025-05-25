@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">
        {{ isset($contact) ? 'Edit Kontak' : 'Tambah Kontak' }}
    </h2>

    <form action="{{ isset($contact) ? route('admin.contact.update', $contact) : route('admin.contact.store') }}" method="POST">
        @csrf
        @if(isset($contact))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                value="{{ old('nama', $contact->nama ?? '') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email', $contact->email ?? '') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Pesan</label>
            <textarea name="pesan" rows="4" class="form-control @error('pesan') is-invalid @enderror" required>{{ old('pesan', $contact->pesan ?? '') }}</textarea>
            @error('pesan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-{{ isset($contact) ? 'primary' : 'success' }}">
            {{ isset($contact) ? 'Perbarui' : 'Simpan' }}
        </button>
    </form>
</div>
@endsection
