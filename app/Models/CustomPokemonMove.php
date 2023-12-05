<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPokemonMove extends Model
{
    use HasFactory;
	
	public function pokemon(){
        return $this->belongsTo(CustomPokemon::class);
    }
}
