@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold">Dashboard Admin</h1>

    <div class="row g-4">
        <!-- Total Pengguna -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <p class="display-6">{{ $userCount }}</p>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-outline-light btn-sm">Lihat Pengguna</a>
                </div>
            </div>
        </div>

        <!-- Total Menu -->
        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Menu</h5>
                    <p class="display-6">{{ $menuCount }}</p>
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-light btn-sm">Lihat Menu</a>
                </div>
            </div>
        </div>

        <!-- Total Order -->
        <div class="col-md-4">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Pesanan</h5>
                    <p class="display-6">{{ $orderCount }}</p>
                    <a href="#" class="btn btn-outline-light btn-sm">Lihat Pesanan</a>
                </div>
            </div>
        </div>

        <!-- Total Rating -->
        <div class="col-md-6">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Rating</h5>
                    <p class="display-6">{{ $ratingCount }}</p>
                    <a href="#" class="btn btn-outline-light btn-sm">Lihat Rating</a>
                </div>
            </div>
        </div>

        <!-- Total Order Item -->
        <div class="col-md-6">
            <div class="card text-white bg-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Item Dipesan</h5>
                    <p class="display-6">{{ $orderItemCount }}</p>
                    <a href="#" class="btn btn-outline-light btn-sm">Lihat Item</a>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div class="alert alert-secondary shadow">
        <h5 class="alert-heading">Informasi Admin</h5>
        <p>Gunakan panel ini untuk melihat statistik singkat sistem. Arahkan ke halaman detail untuk kelola data lebih lanjut.</p>
    </div>
</div>
@endsection
