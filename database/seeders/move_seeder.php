<?php

namespace Database\Seeders;

use App\Models\Type;
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

				// foreign key!!!
				$type = Type::where('name', $data['3'])->first();

                Move::create([
					"name" => $data['1'],
					"type_id" => $type->id,
					"power" => $data['5'],
					"description" => $data['2']
				]);    
            }
            $firstline = false;
		}

		fclose($csvFile);

    }
}