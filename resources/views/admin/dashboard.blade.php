@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
    <p>Email: {{ auth()->user()->email }}</p>
    <p>Role: {{ auth()->user()->role }}</p>
</div>
@endsection
