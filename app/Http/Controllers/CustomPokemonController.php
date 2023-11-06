<?php

namespace App\Http\Controllers;

use App\Models\CustomPokemonMove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CustomPokemon;
use Illuminate\Support\Facades\Log;

class CustomPokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$user = Auth::id();
		$usersCustomPokemon = DB::table('custom_pokemon as c')
								->select('c.id', 'c.nickname as name', 'p.name as rname', 't.name as type', 't2.name as secondary_type', 'p.image_url')
								->join('pokemon as p', 'c.pokemon_id', '=', 'p.id')
								->join('types as t', 'p.type_id', '=', 't.id')
								->join('types as t2', 'p.type_secondary_id', '=', 't2.id')
								->get();
        return view('custom.index', ['pokemon'=>$usersCustomPokemon, 'userid' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$allpokemon = DB::table('pokemon as p')
						->select('p.id', 'p.name', "t.name as type", "t2.name as secondary_type", "p.image_url")
						->join('types as t', 'p.type_id', '=', 't.id')
						->join('types as t2', 'p.type_secondary_id', '=', 't2.id')
						->orderBy('p.id', 'asc')
						->get();

		$allmoves = DB::table('moves as m')
						->select('m.id', 'm.name', "t.name as type", 'm.description')
						->join('types as t', 'm.type_id', '=', 't.id')
						->get();
        return view('custom.create', 
			[
				'pokemon' => $allpokemon,
				'moves' => $allmoves
			]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
			'pokemon' => 'required',

			// moves and nickname are not required
			'nickname' => 'string|nullable',
			'move1' => 'nullable',
			'move2' => 'nullable',
			'move3' => 'nullable',
			'move4' => 'nullable',
		];

		$messages = [
			'pokemon.required' => 'pick a pokemon!!!'
		];
		$request->validate($rules, $messages);
		
		$customPokemon = new CustomPokemon;
		$customPokemon->nickname = ($request->nickname) ? $request->nickname : "None";
		$customPokemon->pokemon_id = $request->pokemon;
		$customPokemon->user_id = Auth::id();

		$customPokemon->save();

		// there is probably a really neat and cool way of doing this where i can for loop through the available moves but they are seperate values?
		if($request->move1){
			$customMove = new CustomPokemonMove;
			$customMove->custom_id = $customPokemon->id;
			$customMove->move_id = $request->move1;
			$customMove->save();
		}
		if($request->move2){
			$customMove = new CustomPokemonMove;
			$customMove->custom_id = $customPokemon->id;
			$customMove->move_id = $request->move2;
			$customMove->save();
		}
		if($request->move3){
			$customMove = new CustomPokemonMove;
			$customMove->custom_id = $customPokemon->id;
			$customMove->move_id = $request->move3;
			$customMove->save();
		}
		if($request->move4){
			$customMove = new CustomPokemonMove;
			$customMove->custom_id = $customPokemon->id;
			$customMove->move_id = $request->move4;
			$customMove->save();
		}

		return redirect()
			->route('custom.index')
			->with('status', 'Custom Pokemon Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		$allpokemon = DB::table('pokemon as p')
						->select('p.id', 'p.name', "t.name as type", "t2.name as secondary_type", "p.image_url")
						->join('types as t', 'p.type_id', '=', 't.id')
						->join('types as t2', 'p.type_secondary_id', '=', 't2.id')
						->orderBy('p.id', 'asc')
						->get();

		$allmoves = DB::table('moves as m')
						->select('m.id', 'm.name', "t.name as type", 'm.description')
						->join('types as t', 'm.type_id', '=', 't.id')
						->orderBy('m.id', 'asc')
						->get();
		
		$mon = CustomPokemon::findOrFail($id);

		$mon = DB::table('custom_pokemon as c')
								->select('c.id', 'c.nickname as name', 'p.name as rname', 't.name as type', 't2.name as secondary_type')
								->join('pokemon as p', 'c.pokemon_id', '=', 'p.id')
								->join('types as t', 'p.type_id', '=', 't.id')
								->join('types as t2', 'p.type_secondary_id', '=', 't2.id')
								->where('c.id', '=', $id)
								->first();
        
		$moves = DB::table('custom_pokemon_moves as cm')
					->select('*')
					->join('custom_pokemon as c', 'c.id', '=', 'cm.custom_id')
					->join('moves as m', 'm.id', '=', 'cm.move_id')
					->where('c.id', '=', $id)
					->orderBy('m.id', 'asc')
					->get();

		return view('custom.edit', [
			'thismon' => $mon,
			'thismoves' => $moves,
			'pokemon' => $allpokemon,
			'moves' => $allmoves
		]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
		// dd($request);
        $rules = [
			'pokemon' => 'required',

			// moves and nickname are not required
			'nickname' => 'string|nullable',
			'move1' => 'nullable',
			'move2' => 'nullable',
			'move3' => 'nullable',
			'move4' => 'nullable',
		];

		$messages = [
			'pokemon.required' => 'pick a pokemon!!!'
		];

		$request->validate($rules,$messages);

		$customPokemon = CustomPokemon::findOrFail($id);
		$customPokemon->nickname = ($request->nickname) ? $request->nickname : "None";
		$customPokemon->pokemon_id = $request->pokemon;
		$customPokemon->user_id = Auth::id();
		$customPokemon->save();

		$cmoves = DB::table('custom_pokemon_moves as cm')
						->select("*")
						->where('cm.custom_id', '=', $id)
						->orderBy('cm.id', 'desc')
						->delete();

		if($request->move1){
			$customMove = new CustomPokemonMove;
			$customMove->custom_id = $customPokemon->id;
			$customMove->move_id = $request->move1;
			$customMove->save();
		}
		if($request->move2){
			$customMove = new CustomPokemonMove;
			$customMove->custom_id = $customPokemon->id;
			$customMove->move_id = $request->move2;
			$customMove->save();
		}
		if($request->move3){
			$customMove = new CustomPokemonMove;
			$customMove->custom_id = $customPokemon->id;
			$customMove->move_id = $request->move3;
			$customMove->save();
		}
		if($request->move4){
			$customMove = new CustomPokemonMove;
			$customMove->custom_id = $customPokemon->id;
			$customMove->move_id = $request->move4;
			$customMove->save();
		}
		
		return redirect()
			->route('custom.index')
			->with('status', 'Custom Pokemon Edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
