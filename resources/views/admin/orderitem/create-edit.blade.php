@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ isset($orderItem) ? 'Edit Order Item' : 'Tambah Order Item' }}</h2>

    <form action="{{ isset($orderItem) ? route('admin.orderitem.update', $orderItem->id) : route('admin.orderitem.store') }}" method="POST">
        @csrf
        @if(isset($orderItem))
            @method('PUT')
        @endif

        <input type="hidden" name="order_id" value="{{ $orderId ?? ($orderItem->order_id ?? '') }}">

        <div class="mb-3">
            <label for="menu_id" class="form-label">Menu</label>
            <select name="menu_id" id="menu_id" class="form-control" required>
                <option value="">-- Pilih Menu --</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ old('menu_id', $orderItem->menu_id ?? '') == $menu->id ? 'selected' : '' }}>
                        {{ $menu->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $orderItem->quantity ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $orderItem->price ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($orderItem) ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('admin.orderitem.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
