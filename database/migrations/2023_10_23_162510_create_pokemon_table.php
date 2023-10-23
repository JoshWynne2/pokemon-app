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
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
			$table->string("name");
			$table->string("image_url");
			$table->int("hp");
			$table->int("attack");
			$table->int("defence");
			$table->int("sp_attack");
			$table->int("sp_defence");
			$table->int("speed");
			$table->foreign('type_id')->references('id')->on('type');
			$table->foreign('type_secondary_id')->references('id')->on('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
