@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold">Edit Alamat & Telepon</h1>

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

    @php
        $editable = in_array(strtolower($order->status), ['menunggu pembayaran', 'diproses']);
    @endphp

    <form action="{{ $editable ? route('admin.order.update', $order->id) : '#' }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Pengiriman</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" {{ !$editable ? 'disabled' : '' }}>{{ old('alamat', $order->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">No. Telepon</label>
            <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon', $order->telepon) }}" {{ !$editable ? 'disabled' : '' }}>
        </div>

        @if($editable)
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        @else
            <div class="alert alert-warning">Alamat dan Telepon tidak dapat diubah karena status order sudah <strong>{{ $order->status }}</strong>.</div>
        @endif

        <a href="{{ route('admin.order.index') }}" class="btn btn-primary">Kembali</a>
    </form>
</div>
@endsection
