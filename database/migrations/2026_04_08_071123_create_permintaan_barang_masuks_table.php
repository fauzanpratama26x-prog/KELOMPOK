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
        Schema::create('permintaan_barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id', 10)->nullable(); // nullable jika barang baru
            $table->string('nama_barang_baru')->nullable(); // untuk barang baru
            $table->string('kategori_baru')->nullable(); // Makanan/Kosmetik/Aksesoris
            $table->decimal('harga_baru', 10, 2)->nullable();
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('user_id'); // gudang user who requested
            $table->unsignedBigInteger('admin_id')->nullable(); // admin who approved/rejected
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id_barang')->on('barangs')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('admin_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_barang_masuks');
    }
};
