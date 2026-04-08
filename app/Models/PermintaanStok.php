<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanStok extends Model
{
    protected $table = 'permintaan_stoks';
    protected $fillable = [
        'gerai_id',
        'barang_id',
        'quantity',
        'status',
        'notes',
        'admin_id',
        'shipped_at',
        'received_at',
    ];
    protected $casts = [
        'shipped_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    public function gerai() { return $this->belongsTo(Gerai::class, 'gerai_id', 'id_gerai'); }
    public function barang() { return $this->belongsTo(Barang::class, 'barang_id', 'id_barang'); }
    public function admin() { return $this->belongsTo(User::class, 'admin_id'); }
}
