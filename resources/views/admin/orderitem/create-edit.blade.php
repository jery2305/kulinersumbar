@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Order Item</h2>
    <div class="alert alert-info">Fitur tambah dan edit order item dinonaktifkan.</div>
    <a href="{{ route('admin.orderitem.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
