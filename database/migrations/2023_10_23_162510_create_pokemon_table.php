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
			$table->integer("hp");
			$table->integer("attack");
			$table->integer("defense");
			$table->integer("sp_attack");
			$table->integer("sp_defense");
			$table->integer("speed");
            $table->timestamps();

			// $table->string('type_id');
			// $table->string('type_secondary_id');
			$table->foreignId('type_id')->references('id')->on('types');
			$table->foreignId('type_secondary_id')->references('id')->on('types')->nullable();
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
