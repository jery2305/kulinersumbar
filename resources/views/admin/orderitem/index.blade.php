@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold">Daftar Rekapan Penjualan</h1>
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

    <!-- Rekap Penjualan -->
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-success bg-opacity-10">
                <div class="card-body">
                    <h6 class="text-muted">Total Pendapatan</h6>
                    <h4 class="fw-bold text-success">
                        Rp{{ number_format($allItems->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-primary bg-opacity-10">
                <div class="card-body">
                    <h6 class="text-muted">Total Item Terjual</h6>
                    <h4 class="fw-bold text-primary">
                        {{ $allItems->sum('quantity') }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-secondary bg-opacity-10">
                <div class="card-body">
                    <h6 class="text-muted">Jumlah Transaksi</h6>
                    <h4 class="fw-bold text-dark"> 
                        {{ $allItems->count() }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Dropdown -->
    <div class="mb-3">
        <label class="form-label">Tampilkan Grafik Berdasarkan</label>
        <select id="grafikSelector" class="form-select w-auto">
            <option value="tanggal">Per Hari</option>
            <option value="bulan">Per Bulan</option>
            <option value="tahun">Per Tahun</option>
        </select>
    </div>
    <canvas id="grafikTransaksi" height="100"></canvas>


    <!-- ➕ Tambah Order Item -->
    <!-- <a href="{{ route('admin.orderitem.form') }}" class="btn btn-primary my-3">
    + Tambah Order Item
    </a> -->

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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataSets = {
        tanggal: {
            labels: {!! json_encode($perTanggal->pluck('label')) !!},
            data: {!! json_encode($perTanggal->pluck('total')) !!},
            label: 'Transaksi per Tanggal'
        },
        bulan: {
            labels: {!! json_encode($perBulan->pluck('label')) !!},
            data: {!! json_encode($perBulan->pluck('total')) !!},
            label: 'Transaksi per Bulan'
        },
        tahun: {
            labels: {!! json_encode($perTahun->pluck('label')) !!},
            data: {!! json_encode($perTahun->pluck('total')) !!},
            label: 'Transaksi per Tahun'
        }
    };

    let chartInstance;
    function renderChart(key) {
        const ctx = document.getElementById('grafikTransaksi').getContext('2d');
        if (chartInstance) chartInstance.destroy();

        const selected = dataSets[key];
        chartInstance = new Chart(ctx, {
            type: 'bar', // Ubah dari 'line' menjadi 'bar'
            data: {
                labels: selected.labels,
                datasets: [{
                    label: selected.label,
                    data: selected.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: { title: { display: true, text: 'Periode' } },
                    y: { beginAtZero: true, title: { display: true, text: 'Jumlah Transaksi' } }
                }
            }
        });
    }

    renderChart('tanggal');
    document.getElementById('grafikSelector').addEventListener('change', function () {
        renderChart(this.value);
    });
</script>

@endsection