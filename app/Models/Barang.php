<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    
    protected $fillable = [
        'id_barang',
        'kategori',
        'nama_barang',
        'harga',
        'stok',
        'suplier'
    ];

    
    

    public function suplierRelasi()
    {
        return $this->belongsTo(Suplier::class, 'suplier', 'id_suplier');
    }
}