<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = "chat";
    protected $fillable = [
        "komplain_id",
        "from_user",
        "to_user",
        "message",
        "is_read"
    ];
}
