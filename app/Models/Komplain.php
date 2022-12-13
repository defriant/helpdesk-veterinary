<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    use HasFactory;

    protected $table = 'komplain';
    protected $fillable = [
        'id',
        'user_id',
        'subjek'
    ];
    public $incrementing = false;

    public function chat()
    {
        return $this->hasMany(Chat::class, 'komplain_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
