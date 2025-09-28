<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admins extends Model
{
    protected $fillable = [
    	"email",
    	"password",
    	"name",
        "profile"
    ];
}
