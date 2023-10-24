<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Move;

class move_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $csvFile = fopen(base_path("database/csvdata/move.csv"), "r");

		$firstline = true;
        while (($data = fgetcsv($csvFile, 200000, ",")) !== FALSE) {
            if (!$firstline) {
                Move::create([
					"name" => $data['1'],
					"type_id" => $data['3'],
					"power" => $data['5'],
					"description" => $data['2']
				]);    
            }
            $firstline = false;
		}

		fclose($csvFile);

    }
}