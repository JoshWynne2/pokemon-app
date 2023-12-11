<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomPokemon;

class Team extends Model
{
    use HasFactory;

	public function user(){
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

	public function pokemon(){
		return $this->hasMany(CustomPokemon::class, 'pokemon_id', 'id');
	}
}
