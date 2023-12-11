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
        Schema::create('custom_pokemon_teams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

			$table->foreignId('team_id')->references('id')->on('teams');
			$table->foreignId('custom_pokemon_id')->references('id')->on('custom_pokemon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_pokemon_teams');
    }
};
