<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';
    protected $fillable = [
        'user_id',
        'jenis',
        'notif',
        'url',
        'is_read'
    ];

    public function user()
    {
        return $this->belongsTo('App/Models/User');
    }
}
