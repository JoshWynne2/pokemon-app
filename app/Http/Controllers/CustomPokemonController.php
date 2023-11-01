<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CustomPokemon;

class CustomPokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$user = Auth::id();
		$usersCustomPokemon = DB::table('custom_pokemon as c')
								->select('c.id', 'c.nickname as name', 'p.name as rname', 't.name as type', 't2.name as secondary_type')
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
			'pokemon' => 'required'
		];

		dd($request);
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
		$mon = CustomPokemon::findOrFail($id);

		$mon = DB::table('custom_pokemon as c')
								->select('c.id', 'c.nickname as name', 'p.name as rname', 't.name as type', 't2.name as secondary_type')
								->join('pokemon as p', 'c.pokemon_id', '=', 'p.id')
								->join('types as t', 'p.type_id', '=', 't.id')
								->join('types as t2', 'p.type_secondary_id', '=', 't2.id')
								->where('c.id', '=', $id)
								->first();
        
		return view('custom.edit', [
			'mon' => $mon
		]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
