<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('gerai_barang_stoks', function (Blueprint $table) {
            $table->id();
            $table->string('gerai_id', 10);
            $table->string('barang_id', 10);
            $table->integer('stok')->default(0);

            $table->foreign('gerai_id')->references('id_gerai')->on('gerais')->cascadeOnDelete();
            $table->foreign('barang_id')->references('id_barang')->on('barangs')->cascadeOnDelete();
            $table->unique(['gerai_id', 'barang_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('gerai_barang_stoks');
    }
};
