<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Asumsi kamu menggunakan auth
            $table->string('nama');
            $table->string('alamat');
            $table->string('telepon');
            $table->string('pembayaran');
            $table->string('status')->default('pending'); // Status pesanan
            $table->string('resi')->nullable(); // Nomor resi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
