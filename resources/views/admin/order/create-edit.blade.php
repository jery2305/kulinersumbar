@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold">{{ isset($order) ? 'Edit Order' : 'Tambah Order' }}</h1>

    {{-- Tampilkan error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($order) ? route('admin.order.update', $order->id) : route('admin.order.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($order))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="user_id" class="form-label">User ID</label>
            <input type="number" name="user_id" id="user_id" class="form-control" value="{{ old('user_id', $order->user_id ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pemesan</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $order->nama ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Pengiriman</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $order->alamat ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">No. Telepon</label>
            <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon', $order->telepon ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="pembayaran" class="form-label">Metode Pembayaran</label>
            <input type="text" name="pembayaran" id="pembayaran" class="form-control" value="{{ old('pembayaran', $order->pembayaran ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                @php
                    $statusOptions = ['Menunggu Pembayaran', 'Diproses', 'Dikirim', 'Selesai'];
                @endphp
                @foreach($statusOptions as $statusOption)
                    <option value="{{ $statusOption }}"
                        {{ old('status', $order->status ?? '') == $statusOption ? 'selected' : '' }}>
                        {{ ucfirst($statusOption) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="resi" class="form-label">No. Resi (Opsional)</label>
            <input type="text" name="resi" id="resi" class="form-control" value="{{ old('resi', $order->resi ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total Pembayaran (Rp)</label>
            <input type="number" name="total" id="total" class="form-control" value="{{ old('total', $order->total ?? '') }}" required min="0">
        </div>

        <div class="mb-3">
        <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran (gambar)</label>
        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" accept="image/*">

        @if(isset($order) && $order->bukti_pembayaran)
            <p class="mt-2">File saat ini:</p>
            <img src="{{ asset('storage/bukti_pembayaran/' . $order->bukti_pembayaran) }}" alt="Bukti Pembayaran" style="max-width: 200px; border-radius: 8px; margin-top: 5px;">
        @endif
    </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($order) ? 'Update' : 'Simpan' }}
        </button>
        <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
