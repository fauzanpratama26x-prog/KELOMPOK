<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeraiBarangStok extends Model
{
    protected $table = 'gerai_barang_stoks';
    protected $fillable = ['gerai_id', 'barang_id', 'stok'];
    public $timestamps = false;

    public function gerai() { return $this->belongsTo(Gerai::class, 'gerai_id', 'id_gerai'); }
    public function barang() { return $this->belongsTo(Barang::class, 'barang_id', 'id_barang'); }
}
