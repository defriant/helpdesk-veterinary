<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $fillable = [
        'id',
        'user_id',
        'nama',
        'telp',
        'alamat',
        'ongkir',
        'total',
        'status',
        'konfirmasi',
        'menunggu_validasi',
        'validasi',
        'pengiriman',
        'tiba_di_tujuan',
        'bukti_pembayaran',
        'alasan_batal'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function pesananbarang()
    {
        return $this->hasMany('App\Models\PesananBarang');
    }
}
