<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPokemon extends Model
{
    use HasFactory;

	public function user(){
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

	// one or two types (many) (second type would be 'null')
	public function type(){
        return $this->hasMany(Type::class);
    }

	public function moves(){
		return $this->hasMany(CustomPokemonMove::class);
	}
}
