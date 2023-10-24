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
        Schema::create('custom_pokemon_move', function (Blueprint $table) {
            $table->id();			
			$table->foreignId('pokemon_id')->references('id')->on('Pokemon');
			$table->foreignId('type_id')->references('id')->on('type');
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
