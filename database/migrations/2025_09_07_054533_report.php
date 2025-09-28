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
        Schema::create("reports",function (Blueprint $table)
        {
        	$table->id();
        	$table->string("owner_id");
        	$table->string("owner");
        	$table->string("value");
        	$table->string("week");
        	$table->string("month");
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("reports");
    }
};
