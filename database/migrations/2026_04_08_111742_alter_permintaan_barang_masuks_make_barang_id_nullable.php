<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For SQLite, we need to recreate the table to change nullability
        Schema::rename('permintaan_barang_masuks', 'permintaan_barang_masuks_old');

        Schema::create('permintaan_barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id', 10)->nullable(); // now nullable
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

        // Copy data
        DB::statement('INSERT INTO permintaan_barang_masuks (id, barang_id, nama_barang_baru, kategori_baru, harga_baru, suplier_baru, quantity, notes, status, user_id, admin_id, approved_at, created_at, updated_at)
                      SELECT id, barang_id, nama_barang_baru, kategori_baru, harga_baru, suplier_baru, quantity, notes, status, user_id, admin_id, approved_at, created_at, updated_at
                      FROM permintaan_barang_masuks_old');

        Schema::drop('permintaan_barang_masuks_old');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse would be to make it NOT NULL again, but since original was nullable, perhaps just drop and recreate
        // But for simplicity, since this is a fix, down can be empty or recreate as NOT NULL
        // But to keep it simple, let's make it NOT NULL in down
        Schema::rename('permintaan_barang_masuks', 'permintaan_barang_masuks_old');

        Schema::create('permintaan_barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id', 10); // NOT NULL
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

            $table->foreign('barang_id')->references('id_barang')->on('barangs')->cascadeOnDelete(); // change to cascade since not null
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('admin_id')->references('id')->on('users')->nullOnDelete();
        });

        DB::statement('INSERT INTO permintaan_barang_masuks (id, barang_id, nama_barang_baru, kategori_baru, harga_baru, suplier_baru, quantity, notes, status, user_id, admin_id, approved_at, created_at, updated_at)
                      SELECT id, barang_id, nama_barang_baru, kategori_baru, harga_baru, suplier_baru, quantity, notes, status, user_id, admin_id, approved_at, created_at, updated_at
                      FROM permintaan_barang_masuks_old
                      WHERE barang_id IS NOT NULL'); // only copy where barang_id is not null

        Schema::drop('permintaan_barang_masuks_old');
    }
};
