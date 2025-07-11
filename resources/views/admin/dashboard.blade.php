@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-5 text-uppercase fw-bold ps-3">Dashboard Admin</h2>

    <div class="row g-4">
        <!-- Card Template -->
        @php
            $cards = [
                [
                    'color' => 'linear-gradient(135deg, #4facfe, #00f2fe)',
                    'title' => 'Daftar Pengguna',
                    'count' => $userCount,
                    'icon' => 'bi-people-fill',
                    'route' => route('admin.user.index')
                ],
                [
                    'color' => 'linear-gradient(135deg, #43e97b, #38f9d7)',
                    'title' => 'Daftar Menu',
                    'count' => $menuCount,
                    'icon' => 'bi-list-ul',
                    'route' => route('admin.menu.index')
                ],
                [
                    'color' => 'linear-gradient(135deg, #f093fb, #f5576c)',
                    'title' => 'Daftar Rekap Penjualan',
                    'count' => $orderItemCount,
                    'icon' => 'bi-box-seam',
                    'route' => route('admin.orderitem.index')
                ],
                [
                    'color' => 'linear-gradient(135deg, #ffc107, #fd7e14)',
                    'title' => 'Daftar Order',
                    'count' => $orderCount,
                    'icon' => 'bi-bag-check-fill',
                    'route' => route('admin.order.index')
                ],
                [
                    'color' => 'linear-gradient(135deg, #17a2b8, #20c997)',
                    'title' => 'Daftar Rating',
                    'count' => $ratingCount,
                    'icon' => 'bi-star-fill',
                    'route' => route('admin.rating.index')
                ],
                [
                    'color' => 'linear-gradient(135deg, #6f42c1, #e83e8c)',
                    'title' => 'Daftar Kontak',
                    'count' => $contactCount,
                    'icon' => 'bi-envelope-fill',
                    'route' => route('admin.contact.index')
                ],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow border-0 text-white h-100" style="background: {{ $card['color'] }}; border-radius: 1rem;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">{{ $card['title'] }}</h5>
                        <p class="display-6 fw-bold mb-3">{{ $card['count'] }}</p>
                        <a href="{{ $card['route'] }}" class="btn btn-outline-light btn-sm rounded-pill">Lihat</a>
                    </div>
                    <i class="bi {{ $card['icon'] }} fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <hr class="my-5">

    <div class="alert alert-light border shadow-sm text-center">
        <h5 class="alert-heading text-dark"><i class="bi bi-info-circle-fill me-2"></i>Informasi Panel Admin</h5>
        <p class="mb-0 text-secondary">Pantau aktivitas sistem dan kelola data melalui panel ini. Klik tombol "Lihat" untuk membuka data secara rinci.</p>
    </div>
</div>
@endsection
