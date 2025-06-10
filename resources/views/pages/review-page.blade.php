@extends('layouts.app')

@section('title', 'Review dan Ulasan Menu')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $menu->name }}</h1>
    <img src="{{ asset('img/'.$menu->image) }}" alt="{{ $menu->name }}" class="w-full rounded-lg shadow mb-6">

    <p class="text-lg text-gray-600 mb-4">
        {{ $menu->description }} <br>
        <strong class="text-red-600">Rp {{ number_format($menu->price, 0, ',', '.') }}</strong>
    </p>

    @if($canReview)
        <x-review-form :menu="$menu" :success="session('success_menu_id') === $menu->id ? session('success') : null"/>
    @else
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-6 text-sm">
            🔒 Anda harus memesan menu ini terlebih dahulu dan menyelesaikan pesanan untuk memberikan ulasan.
        </div>
    @endif

</div>
@endsection
