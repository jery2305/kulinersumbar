<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
       Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');  // Menambahkan menu_id
            $table->string('nama');
            $table->string('alamat');
            $table->string('telepon');
            $table->string('pembayaran');
            $table->string('resi')->unique();
            $table->enum('status', ['Menunggu Pembayaran', 'Dikirim', 'Selesai'])->default('Menunggu Pembayaran');  // Opsional enum untuk status
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};