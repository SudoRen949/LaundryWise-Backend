<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
    	"customer",
    	"customer_id",
    	"contact",
    	"address",
    	"service",
    	"service_owner",
    	"service_owner_id",
    	"shop_name",
    	"payment_type",
    	"pickup_date",
    	"pickup_time",
    	"total_payment",
    	"reference_code",
    	"date_ordered",
    	"status"
    ];
}
