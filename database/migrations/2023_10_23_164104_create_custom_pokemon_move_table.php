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
        Schema::create('custom_pokemon_moves', function (Blueprint $table) {
            $table->id();			
			$table->foreignId('custom_id')->references('id')->on('custom_pokemon');
			$table->foreignId('move_id')->references('id')->on('moves');
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_pokemon_move');
    }
};
