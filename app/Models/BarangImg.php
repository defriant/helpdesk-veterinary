<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangImg extends Model
{
    use HasFactory;

    protected $table = 'barang_img';
    protected $fillable = [
        'id_barang',
        'gambar'
    ];
}
