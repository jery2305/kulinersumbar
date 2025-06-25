@extends('layouts.app')

@section('title', 'Pengiriman')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-6">Informasi Pengiriman</h1>
    <p class="mb-4">
        Kami melayani pengiriman ke seluruh wilayah Indonesia dengan kerja sama bersama kurir terpercaya. Berikut detail pengiriman:
    </p>
    <ul class="list-disc ml-6 space-y-2">
        <li>Proses pengemasan dilakukan dalam 1-2 hari kerja setelah pembayaran diterima.</li>
        <li>Lama pengiriman tergantung lokasi tujuan, rata-rata 2–5 hari kerja.</li>
        <li>Nomor resi akan dikirim ke email/WhatsApp pelanggan setelah barang dikirim.</li>
        <li>Biaya pengiriman dihitung otomatis berdasarkan lokasi dan berat produk.</li>
    </ul>
</div>
@endsection
