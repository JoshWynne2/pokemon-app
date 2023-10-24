<?php

namespace Database\Seeders;

use App\Models\pokemon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pokemon_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		pokemon::truncate();

		$csvFile = fopen(base_path("database/csvdata/pokemon.csv"), "r");

		$firstline = true;
        while (($data = fgetcsv($csvFile, 200000, ",")) !== FALSE) {
            if (!$firstline) {
                pokemon::create([
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
					// PLEASE FIX THIS? I NEED TO QUEREY TYPES BY NAME FROM THE CSV
                ]);    
            }
            $firstline = false;
        }

		fclose($csvFile);
    }
}
