<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifs extends Model
{
    protected $fillable = [
    	"date",
    	"from",
    	"to",
    	"details"
    ];
}
