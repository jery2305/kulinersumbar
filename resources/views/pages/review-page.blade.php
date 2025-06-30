@extends('layouts.app')

@section('title', 'Review dan Ulasan Menu')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">

    <!-- Judul -->
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4 border-b pb-2">
        {{ $menu->name }}
    </h1>

    <!-- Gambar -->
    <div class="w-full max-w-md mx-auto mb-6">
        <img src="{{ asset('img/'.$menu->image) }}"
            alt="{{ $menu->name }}"
            class="w-full h-auto rounded-xl shadow" />
    </div>

    <!-- Deskripsi & Harga -->
    <div class="mb-8 bg-gray-50 border border-gray-200 p-6 rounded-xl shadow-sm">
        <p class="text-gray-700 text-base md:text-lg leading-relaxed">
            {{ $menu->description }}
        </p>
        <p class="text-xl font-semibold text-red-600 mt-4">
            Rp {{ number_format($menu->price, 0, ',', '.') }}
        </p>
    </div>

    <!-- Review Form atau Info -->
    @if($canReview)
        <div class="bg-white border border-gray-200 shadow-md p-6 rounded-xl">
            <x-review-form :menu="$menu" :success="session('success_menu_id') === $menu->id ? session('success') : null"/>
        </div>
    @else
        <div class="flex items-center bg-yellow-100 text-yellow-900 border-l-4 border-yellow-500 p-5 rounded-xl shadow-sm mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-yellow-600" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
            <span>
                Anda harus <strong>memesan</strong> menu ini dan <strong>menyelesaikan pesanan</strong> untuk memberikan ulasan.
            </span>
        </div>
    @endif

</div>
@endsection
