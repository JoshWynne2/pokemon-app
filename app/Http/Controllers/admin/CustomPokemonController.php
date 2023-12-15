<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CustomPokemonMove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CustomPokemon;
use Illuminate\Support\Facades\Log;
use App\Models\User;

use Auth;

class CustomPokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		Auth::user()->authorizeRoles('admin');

		if(!Auth::user()->hasRole('admin')){
			return to_route('user.custom.index');
		}

		//show ALL the pokemon
		$usersCustomPokemon = DB::table('custom_pokemon as c')
								->select('c.id', 'c.nickname as name', 'p.name as rname', 't.name as type', 't2.name as secondary_type', 'p.image_url', 'c.user_id')
								->join('pokemon as p', 'c.pokemon_id', '=', 'p.id')
								->join('types as t', 'p.type_id', '=', 't.id')
								->join('types as t2', 'p.type_secondary_id', '=', 't2.id')
								->join('users as u', 'c.user_id', '=', 'u.id')
								->get();

		$users = User::all();

        return view('custom.admin.index', ['pokemon'=>$usersCustomPokemon, 'userid' => Auth::id(), 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		if(!Auth::user()->hasRole('admin')){
			return to_route('user.custom.index');
		}

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
		if(!Auth::user()->hasRole('admin')){
			return to_route('user.custom.index');
		}

        $mon = DB::table('custom_pokemon as c')
								->select('c.id', 'c.nickname as name', 'p.name as rname', 't.name as type', 't2.name as secondary_type', 'p.image_url')
								->join('pokemon as p', 'c.pokemon_id', '=', 'p.id')
								->join('types as t', 'p.type_id', '=', 't.id')
								->join('types as t2', 'p.type_secondary_id', '=', 't2.id')
								->where('c.id', '=', $id)
								->first();

		$moves = DB::table('custom_pokemon_moves as cm')
					->select('c.id', 'm.name', 't.name as type', 'm.description')
					->join('custom_pokemon as c', 'c.id', '=', 'cm.custom_id')
					->join('moves as m', 'm.id', '=', 'cm.move_id')
					->join('types as t', 't.id', '=', 'm.type_id')
					->where('c.id', '=', $id)
					->orderBy('m.id', 'desc')
					->get();

		return view('custom.show', ["id" => $id, "mon" => $mon, "moves" => $moves]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		if(!Auth::user()->hasRole('admin')){
			return to_route('user.custom.index');
		}

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

		// the only way this message could actually appear is if the user does some crazy form injections OR the pokemon database is empty
		$messages = [
			'pokemon.required' => 'pick a pokemon!!!'
		];

		$request->validate($rules,$messages);

		$customPokemon = CustomPokemon::findOrFail($id);
		$customPokemon->nickname = ($request->nickname) ? $request->nickname : "None";
		$customPokemon->pokemon_id = $request->pokemon;
		$customPokemon->user_id = Auth::id();
		$customPokemon->save();

		/*
			to cover every edge case of custom pokemon not always having 4 moves and searching and finding

			editing existing custom moves would look like this:

			see how many moves the pokemon has
			see how many have been edited
			see which ones have been edited and change those
			if a new one was added make it
			if an old one was deleted delete it

			instead im:

			deleting all old moves assocaited with the custom pokemon
			creating all new moves associated with the custom pokemon

			because the old data is submitted through the form anyway this works in every situation
			main issue is that the ID numbers will quickly inflate but theres probably a way to fix that with a trigger or something 
		*/
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
			->route('custom.show', $id)
			->with('status', 'Custom Pokemon Edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
		if(!Auth::user()->hasRole('admin')){
			return to_route('user.custom.index');
		}
		
		// delete set moves for the pokemon
		$cmoves = DB::table('custom_pokemon_moves as cm')
						->select("*")
						->where('cm.custom_id', '=', $id)
						->orderBy('cm.id', 'desc')
						->delete();

		// delete the pokemon 
		$mon = CustomPokemon::findOrFail($id);
		$mon->delete();
		
		return redirect()
			->route("custom.index")
			->with("status", "Custom Pokemon Deleted");

		// return view("custom.index");
    }
}
