<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = [
        'id',
        'jenis',
        'nama',
        'harga',
        'stock',
        'gambar',
        'deskripsi',
        'terjual',
        'dilihat'
    ];

    public $incrementing = false;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function barangimg()
    {
        return $this->hasMany(BarangImg::class, 'id_barang', 'id');
    }
}
