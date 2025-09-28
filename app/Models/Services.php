<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Services extends Model
{
    protected $fillable = [
    	"owner_id",
    	"owner",
    	"name",
    	"address",
    	"contact",
    	"banner",
    	"time",
    	"prices",
    	"qr"
    ];
}
