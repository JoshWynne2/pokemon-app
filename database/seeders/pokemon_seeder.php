<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pokemon_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		// opening the csv file
		$csvFile = fopen(base_path("database/csvdata/pokemon.csv"), "r");

		$firstline = true;
		// going through each line of the csv to extract data
        while (($data = fgetcsv($csvFile, 200000, ",")) !== FALSE) {
            if (!$firstline) {

				$type1 = Type::where('name', $data['4'])->first();
				$type2 = Type::where('name', $data['5'])->first();

                Pokemon::create([
                    "name" => $data['2'],
                    "image_url" => '#', // make this work!!
					"hp" => $data['9'],
					"attack" => $data['10'],
					"defense" => $data['11'],
					"sp_attack" => $data['12'],
					"sp_defense" => $data['13'],
					"speed" => $data['14'],
					"type_id" => $type1->id,
					"type_secondary_id" => $type2->id // make null correction a thing :3
                ]);    
            }
            $firstline = false;
        }

		fclose($csvFile);
    }
}
