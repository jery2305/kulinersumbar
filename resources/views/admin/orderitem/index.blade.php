@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold">Daftar Order Item</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Dashboard
        </a>
    </div>

    <!-- 🔍 Filter Waktu -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-3">Filter Waktu Transaksi</h5>
            <form method="GET" action="{{ route('admin.orderitem.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Spesifik</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control shadow-sm">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Bulan</label>
                    <select name="bulan" class="form-select shadow-sm">
                        <option value="">-- Semua Bulan --</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tahun</label>
                    <select name="tahun" class="form-select shadow-sm">
                        <option value="">-- Semua Tahun --</option>
                        @for ($y = now()->year; $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-filter me-1"></i> Terapkan Filter
                    </button>
                    <a href="{{ route('admin.orderitem.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- 📊 Rekap Penjualan -->
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-success bg-opacity-10">
                <div class="card-body">
                    <h6 class="text-muted">Total Pendapatan</h6>
                    <h4 class="fw-bold text-success">
                        Rp{{ number_format($orderItems->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-primary bg-opacity-10">
                <div class="card-body">
                    <h6 class="text-muted">Total Item Terjual</h6>
                    <h4 class="fw-bold text-primary">
                        {{ $orderItems->sum('quantity') }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-secondary bg-opacity-10">
                <div class="card-body">
                    <h6 class="text-muted">Jumlah Transaksi</h6>
                    <h4 class="fw-bold text-dark">
                        {{ $orderItems->count() }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- ➕ Tambah Order Item -->
    <a href="{{ route('admin.orderitem.form') }}" class="btn btn-primary mb-3">
        + Tambah Order Item
    </a>

    <!-- 📋 Tabel Order Item -->
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
                    <td>{{ $loop->iteration + ($orderItems->currentPage() - 1) * $orderItems->perPage() }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>{{ $item->menu->name ?? $item->menu_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.orderitem.form', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.orderitem.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- 📄 Navigasi Halaman -->
        <div class="mt-3 d-flex justify-content-center">
            {{ $orderItems->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
