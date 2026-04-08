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
        Schema::table('permintaan_barang_masuks', function (Blueprint $table) {
            $table->string('nama_barang_baru')->nullable()->after('barang_id');
            $table->string('kategori_baru')->nullable()->after('nama_barang_baru');
            $table->decimal('harga_baru', 10, 2)->nullable()->after('kategori_baru');
            $table->string('suplier_baru')->nullable()->after('harga_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permintaan_barang_masuks', function (Blueprint $table) {
            $table->dropColumn(['nama_barang_baru', 'kategori_baru', 'harga_baru', 'suplier_baru']);
        });
    }
};
