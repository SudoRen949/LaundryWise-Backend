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
        Schema::create("services", function (Blueprint $table)
		{
			$table->id();
			$table->string("owner_id");
			$table->string("owner");
			$table->string("name");
			$table->string("address");
			$table->string("contact");
			$table->longText("banner");
			$table->string("time");
			$table->string("prices");
			$table->longText("qr")->nullable();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("services");
    }
};
