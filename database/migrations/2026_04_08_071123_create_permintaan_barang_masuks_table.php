<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('permintaan_barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id', 10)->nullable(); 
            $table->string('nama_barang_baru')->nullable(); 
            $table->string('kategori_baru')->nullable(); 
            $table->decimal('harga_baru', 10, 2)->nullable();
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('admin_id')->nullable(); 
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id_barang')->on('barangs')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('admin_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('permintaan_barang_masuks');
    }
};
