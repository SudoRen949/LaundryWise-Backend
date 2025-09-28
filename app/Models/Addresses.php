<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Addresses extends Model
{
    protected $fillable = [
        "user",
        "user_id",
        "address",
        "type"
    ];
}
