<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use DB;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

		// $allpokemon = DB::table('pokemon')->where('type_id', '2')->get();

		$allpokemon = DB::table('pokemon as p')
						->select('p.name', "t.name as type", "t2.name as secondary_type", "p.image_url")
						->join('types as t', 'p.type_id', '=', 't.id')
						->join('types as t2', 'p.type_secondary_id', '=', 't2.id')
						->get();

        return view('pokemon.index', ['pokemon' => $allpokemon]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
