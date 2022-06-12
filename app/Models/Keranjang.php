<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $fillable = [
        'user_id',
        'barang_id',
        'nama',
        'harga',
        'jumlah',
        'total',
        'gambar',
        'url'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
