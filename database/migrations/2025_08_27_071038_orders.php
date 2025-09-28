<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("orders",function (Blueprint $table) 
        {
        	$table->id();
        	$table->string("customer");
        	$table->string("customer_id");
        	$table->string("contact");
        	$table->string("address");
        	$table->string("service");
        	$table->string("service_owner");
        	$table->string("service_owner_id");
        	$table->string("shop_name");
        	$table->string("payment_type");
        	$table->string("pickup_date");
        	$table->string("pickup_time");
        	$table->string("total_payment");
        	$table->string("reference_code");
        	$table->string("date_ordered");
        	$table->string("status");
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("orders");
    }
};
