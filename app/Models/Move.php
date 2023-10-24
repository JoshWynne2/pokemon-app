<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;

	public function type(){
		return $this->hasOne(type::class);
	}
	// protected $table = 'move';
}
