<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\CustomPokemon;
use App\Models\CustomPokemonTeam;
use App\Models\Pokemon;
use Illuminate\Http\Request;	
use App\Models\Team;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		if(Auth::user()->hasRole('admin')){
			return to_route('admin.teams.index');
		}

		$teams = Team::select('*')->where('user_id', '=', Auth::id())->get();
		$teamPokemon = CustomPokemonTeam::all();
		$pokemon = Pokemon::all();
		$customPokemon = CustomPokemon::all();

        return view('teams.index', ['teams' => $teams, 'teamPokemon' => $teamPokemon, 'pokemon' => $pokemon, 'customPokemon' => $customPokemon]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		//only show the users own teams (commented out rn)
		$user = Auth::id();
		$usersCustomPokemon = DB::table('custom_pokemon as c')
								->select('c.id', 'c.nickname as name', 'p.name as rname', 't.name as type', 't2.name as secondary_type', 'p.image_url')
								->join('pokemon as p', 'c.pokemon_id', '=', 'p.id')
								->join('types as t', 'p.type_id', '=', 't.id')
								->join('types as t2', 'p.type_secondary_id', '=', 't2.id')
								->join('users as u', 'c.user_id', '=', 'u.id')
								->where('u.id', '=', $user)
								->get();

								
		
        return view('teams.create', ['pokemon' => $usersCustomPokemon]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$rules = [
			'name' => 'string|required',
			'description' => 'string|nullable',

			'pokemon1' => 'nullable',
			'pokemon2' => 'nullable',
			'pokemon3' => 'nullable',
			'pokemon4' => 'nullable',
			'pokemon5' => 'nullable',
			'pokemon6' => 'nullable',
		];

		$messages = [
			'name.required' => 'type a name!'
		];
		// dd($request);
		
		$request->validate($rules, $messages);
		
		$team = new Team;
		$team->name = ($request->name) ? $request->name : "None";
		$team->description = ($request->description) ? $request->description : "None";
		$team->user_id = Auth::id();

		$team->save();

		// there is probably a really neat and cool way of doing this where i can for loop through the available moves but they are seperate values?
		if($request->pokemon1){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon1;
			$teamPokemon->save();
		}
		if($request->pokemon2){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon2;
			$teamPokemon->save();
		}
		if($request->pokemon3){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon3;
			$teamPokemon->save();
		}
		if($request->pokemon4){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon4;
			$teamPokemon->save();
		}
		if($request->pokemon5){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon5;
			$teamPokemon->save();
		}
		if($request->pokemon6){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon6;
			$teamPokemon->save();
		}

		return redirect()
			->route('teams.index')
			->with('status', 'Team Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
		$team = Team::findOrFail($id);
		$teamPokemon = CustomPokemonTeam::all();
		$pokemon = Pokemon::all();
		$customPokemon = CustomPokemon::all();
	
        return view('teams.show', ['team' => $team, 'teamPokemon' => $teamPokemon, 'pokemon' => $pokemon, 'customPokemon' => $customPokemon]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		if(Auth::user()->hasRole('admin')){
			return to_route('admin.teams.edit', $id);
		}


		$team = Team::findOrFail($id);
		
		$teamPokemon = DB::table('custom_pokemon_teams')
						->select('*')
						->where('team_id', '=', $id)
						->get();

		$pokemon = Pokemon::all();
		$customPokemon = CustomPokemon::select('*')->where('user_id', '=', Auth::id())->get();

        return view('teams.edit', ['team' => $team, 'teamPokemon' => $teamPokemon, 'pokemon' => $pokemon, 'customPokemon' => $customPokemon]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
		$rules = [
			'name' => 'string|required',
			'description' => 'string|nullable',

			'pokemon1' => 'nullable',
			'pokemon2' => 'nullable',
			'pokemon3' => 'nullable',
			'pokemon4' => 'nullable',
			'pokemon5' => 'nullable',
			'pokemon6' => 'nullable',
		];

		$messages = [
			'name.required' => 'type a name!'
		];
		// dd($request);
		
		$request->validate($rules, $messages);
		
		$team = Team::findOrFail($id);  //because the edit has everything pre filled in I just overwrite with the new data anyway
		$team->name = ($request->name) ? $request->name : "None";
		$team->description = ($request->description) ? $request->description : "None";
		$team->user_id = Auth::id();

		$team->save();

		// like in the custom pokemon controller, instead of finding an undeterminind amount of pokemon i just delete what we have in the pivot tables and then re asign them
		$tpokmeon = DB::table('custom_pokemon_teams as tm')
					->select("*")
					->where('tm.team_id', '=', $id)
					->delete();

		if($request->pokemon1){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon1;
			$teamPokemon->save();
		}
		if($request->pokemon2){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon2;
			$teamPokemon->save();
		}
		if($request->pokemon3){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon3;
			$teamPokemon->save();
		}
		if($request->pokemon4){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon4;
			$teamPokemon->save();
		}
		if($request->pokemon5){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon5;
			$teamPokemon->save();
		}
		if($request->pokemon6){
			$teamPokemon = new CustomPokemonTeam;
			$teamPokemon->team_id = $team->id;
			$teamPokemon->custom_pokemon_id = $request->pokemon6;
			$teamPokemon->save();
		}

		return redirect()
			->route('teams.show', $id)
			->with('status', 'Team Edited');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
		// delete set pokemon for the team
		$tpokmeon = DB::table('custom_pokemon_teams as tm')
					->select("*")
					->where('tm.team_id', '=', $id)
					->delete();

		// delete the team 
		$team = Team::findOrFail($id);
		$team->delete();

		return redirect()
		->route("teams.index")
		->with("status", "Team Deleted");
    }
}
