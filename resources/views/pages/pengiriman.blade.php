@extends('layouts.app')

@section('title', 'Pengiriman')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-6">Informasi Pengiriman</h1>
    <p class="mb-4">
        Kami melayani pengiriman ke seluruh wilayah Indonesia dengan kerja sama bersama kurir terpercaya. Berikut detail pengiriman:
    </p>
    <ul class="list-disc ml-6 space-y-2">
        <li>Proses pengemasan dilakukan apabila sudah melakukan pembayaran</li>
        <li>Lama pengiriman tergantung lokasi tujuan, rata-rata 15-30 tergantung lokasi anda.</li>
        <li>Nomor resi akan dikirim ke email/WhatsApp pelanggan setelah barang dikirim.</li>
        <li>Biaya pengiriman dihitung gratis.</li>
    </ul>
</div>
@endsection
