@extends('layouts.admin')

@section('content')
<div class="container">
     <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold">Daftar Order Item</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Dashboard
        </a>
    </div>
    
    <a href="{{ route('admin.orderitem.form') }}" class="btn btn-primary mb-3">
        + Tambah Order Item
    </a>

    <div class="table-responsive shadow-sm border rounded">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Order ID</th>
                    <th>Menu</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>{{ $item->menu->name ?? $item->menu_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.orderitem.form', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.orderitem.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
