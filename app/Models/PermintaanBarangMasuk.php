<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanBarangMasuk extends Model
{
    protected $fillable = [
        'barang_id',
        'nama_barang_baru',
        'kategori_baru',
        'harga_baru',
        'suplier_baru',
        'quantity',
        'notes',
        'status',
        'user_id',
        'admin_id',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
