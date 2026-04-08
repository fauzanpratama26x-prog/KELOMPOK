<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('gerai_id', 10);
            $table->string('barang_id', 10);
            $table->integer('quantity');
            $table->integer('total');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->foreign('gerai_id')->references('id_gerai')->on('gerais')->cascadeOnDelete();
            $table->foreign('barang_id')->references('id_barang')->on('barangs')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transaksis');
    }
};
