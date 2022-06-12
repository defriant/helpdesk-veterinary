<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananBarang extends Model
{
    use HasFactory;

    protected $table = 'pesanan_barang';
    protected $fillable = [
        'pesanan_id',
        'barang_id',
        'nama',
        'warna',
        'panjang',
        'lebar',
        'harga',
        'jumlah',
        'total',
        'gambar',
        'detail_barang',
        'url'
    ];

    public function pesanan()
    {
        return $this->belongsTo('App\Models\Pesanan');
    }
}
