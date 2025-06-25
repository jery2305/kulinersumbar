@extends('layouts.admin')

@section('content')
<div class="container">
     <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold">Daftar Order</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('admin.order.form') }}" class="btn btn-success mb-3">Tambah Order Baru</a>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>User ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Pembayaran</th>
                <th>Status</th>
                <th>Resi</th>
                <th>Total</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td class="text-center">{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                    <td class="text-center">{{ $order->user_id }}</td>
                    <td>{{ $order->nama }}</td>
                    <td>{{ $order->alamat }}</td>
                    <td>{{ $order->telepon }}</td>
                    <td>{{ $order->pembayaran }}</td>
                    @php
                        $statusLower = strtolower($order->status);
                        if ($statusLower === 'selesai') {
                            $badgeClass = 'bg-success';
                        } elseif ($statusLower === 'dibatalkan') {
                            $badgeClass = 'bg-danger'; // warna merah
                        } else {
                            $badgeClass = 'bg-secondary'; // default abu-abu
                        }
                    @endphp
                    <td class="text-center">
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    
                    <td>{{ $order->resi ?? '-' }}</td>
                    <td class="text-end">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    
                    <td class="text-center">
                        @if($order->bukti_pembayaran)
                            <img src="{{ asset($order->bukti_pembayaran) }}" 
                                alt="Bukti Pembayaran" 
                                style="max-width: 100px; border-radius: 6px; cursor: pointer;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalBukti{{ $order->id }}">
                        @else
                            <span class="text-muted fst-italic">Belum dikirim</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('admin.order.form', $order->id) }}" class="btn btn-sm btn-primary me-1">Edit</a>

                        @php
                            $confirmableStatuses = ['menunggu pembayaran', 'diproses', 'dikirim'];
                            $status = strtolower($order->status);
                        @endphp

                        @if(in_array($status, $confirmableStatuses))
                            <form action="{{ route('admin.order.confirm', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <select name="new_status" onchange="if(this.value) this.form.submit()" class="form-select form-select-sm d-inline w-auto">
                                    <option value="">Konfirmasi ke...</option>
                                    @if($status == 'menunggu pembayaran')
                                        <option value="diproses">Diproses</option>
                                        <option value="dikirim">Dikirim</option>
                                        <option value="selesai">Selesai</option>
                                    @elseif($status == 'diproses')
                                        <option value="dikirim">Dikirim</option>
                                        <option value="selesai">Selesai</option>
                                    @elseif($status == 'dikirim')
                                        <option value="selesai">Selesai</option>
                                    @endif
                                </select>
                            </form>
                        @endif

                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus order ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Belum ada data order.</td>
                </tr>
            @endforelse
        </tbody>
            @foreach($orders as $order)
                @if($order->bukti_pembayaran)
                <!-- Modal -->
                <div class="modal fade" id="modalBukti{{ $order->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $order->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel{{ $order->id }}">Bukti Pembayaran - Order #{{ $order->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body text-center">
                            <img 
                                src="{{ asset($order->bukti_pembayaran) }}" 
                                alt="Bukti Pembayaran" 
                                class="img-fluid rounded shadow" 
                                style="max-height: 350px; max-width: 100%; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </table>

    <div class="mt-3 d-flex justify-content-center">
        {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
