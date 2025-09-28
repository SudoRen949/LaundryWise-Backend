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
        Schema::create("notifs",function (Blueprint $table)
        {
        	// Example notification (Owner)
        	////////////////////////////////////////////////////////////
        	// 05/05/2025
        	// (NAME) has placed an order to your shop (SHOP_NAME)
        	// Go to "Manage orders" to see more.
        	////////////////////////////////////////////////////////////

        	// Example notification (Customer)
        	////////////////////////////////////////////////////////////////////////
        	// 05/05/2025
        	// (OWNER_NAME) from (SHOP_NAME) just changed the status of your order
        	// Go to "Order history" to see more.
        	////////////////////////////////////////////////////////////////////////

        	$table->id();
        	$table->string("date");
        	$table->string("from");
        	$table->string("to");
        	$table->string("details");
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("notifs");
    }
};
