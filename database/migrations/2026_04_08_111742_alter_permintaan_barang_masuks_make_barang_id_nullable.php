<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    
    public function up(): void
    {
        
        Schema::rename('permintaan_barang_masuks', 'permintaan_barang_masuks_old');

        Schema::create('permintaan_barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id', 10)->nullable(); 
            $table->string('nama_barang_baru')->nullable();
            $table->string('kategori_baru')->nullable();
            $table->decimal('harga_baru', 10, 2)->nullable();
            $table->string('suplier_baru')->nullable();
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

        
        DB::statement('INSERT INTO permintaan_barang_masuks (id, barang_id, nama_barang_baru, kategori_baru, harga_baru, suplier_baru, quantity, notes, status, user_id, admin_id, approved_at, created_at, updated_at)
                      SELECT id, barang_id, nama_barang_baru, kategori_baru, harga_baru, suplier_baru, quantity, notes, status, user_id, admin_id, approved_at, created_at, updated_at
                      FROM permintaan_barang_masuks_old');

        Schema::drop('permintaan_barang_masuks_old');
    }

    
    public function down(): void
    {
        
        
        
        Schema::rename('permintaan_barang_masuks', 'permintaan_barang_masuks_old');

        Schema::create('permintaan_barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id', 10); 
            $table->string('nama_barang_baru')->nullable();
            $table->string('kategori_baru')->nullable();
            $table->decimal('harga_baru', 10, 2)->nullable();
            $table->string('suplier_baru')->nullable();
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id_barang')->on('barangs')->cascadeOnDelete(); 
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('admin_id')->references('id')->on('users')->nullOnDelete();
        });

        DB::statement('INSERT INTO permintaan_barang_masuks (id, barang_id, nama_barang_baru, kategori_baru, harga_baru, suplier_baru, quantity, notes, status, user_id, admin_id, approved_at, created_at, updated_at)
                      SELECT id, barang_id, nama_barang_baru, kategori_baru, harga_baru, suplier_baru, quantity, notes, status, user_id, admin_id, approved_at, created_at, updated_at
                      FROM permintaan_barang_masuks_old
                      WHERE barang_id IS NOT NULL'); 

        Schema::drop('permintaan_barang_masuks_old');
    }
};
