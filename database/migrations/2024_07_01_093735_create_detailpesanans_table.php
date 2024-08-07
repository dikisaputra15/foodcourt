<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detailpesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pesanan');
            $table->integer('id_produk');
            $table->integer('id_warung');
            $table->integer('jml');
            $table->double('harga_bayar');
            $table->double('sub_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailpesanans');
    }
};
