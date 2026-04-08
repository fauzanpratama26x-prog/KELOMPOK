<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('permintaan_stoks', function (Blueprint $table) {
            $table->id();
            $table->string('gerai_id', 10);
            $table->string('barang_id', 10);
            $table->integer('quantity');
            $table->enum('status', ['pending', 'approved', 'rejected', 'shipped', 'received'])->default('pending');
            $table->text('notes')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamps();

            $table->foreign('gerai_id')->references('id_gerai')->on('gerais')->cascadeOnDelete();
            $table->foreign('barang_id')->references('id_barang')->on('barangs')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('permintaan_stoks');
    }
};
