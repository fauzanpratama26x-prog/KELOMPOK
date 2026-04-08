<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = ['gerai_id', 'barang_id', 'quantity', 'total', 'user_id'];

    public function gerai() { return $this->belongsTo(Gerai::class, 'gerai_id', 'id_gerai'); }
    public function barang() { return $this->belongsTo(Barang::class, 'barang_id', 'id_barang'); }
    public function user() { return $this->belongsTo(User::class); }
}
