<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
    	"owner_id",
    	"owner",
    	"value",
    	"week",
    	"month"
    ];
}
