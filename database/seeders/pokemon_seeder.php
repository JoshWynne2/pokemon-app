<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pokemon_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

		$csvFile = fopen(base_path("database/csvdata/pokemon.csv"), "r");

		$firstline = true;
        while (($data = fgetcsv($csvFile, 200000, ",")) !== FALSE) {
            if (!$firstline) {
                Pokemon::create([
                    "name" => $data['2'],
                    "image_url" => '#',
					"hp" => $data['9'],
					"attack" => $data['10'],
					"defense" => $data['11'],
					"sp_attack" => $data['12'],
					"sp_defense" => $data['13'],
					"speed" => $data['14'],
					"type_id" => $data['4'],
					"type_secondary_id" => $data['5'] 
                ]);    
            }
            $firstline = false;
        }

		fclose($csvFile);
    }
}
