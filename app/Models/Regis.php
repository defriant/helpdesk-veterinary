<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regis extends Model
{
    use HasFactory;

    protected $table = 'confirm_regis';
    protected $fillable = [
        'id',
        'nama',
        'telp',
        'alamat',
        'email',
        'password',
        'code'
    ];
}
