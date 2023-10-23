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
        Schema::create('custom_pokemon', function (Blueprint $table) {
            $table->id();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('pokemon_id')->references('id')->on('pokemon');
			$table->string('nickname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_pokemon');
    }
};
