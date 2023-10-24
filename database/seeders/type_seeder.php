<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class type_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		// i made this csv myself, its a list of every type and a colour to go with it
        $csvFile = fopen(base_path("database/csvdata/type.csv"), "r");

		$firstline = true;
        while (($data = fgetcsv($csvFile, 300, ",")) !== FALSE) {
            if (!$firstline) {
                Type::create([
					"name" => $data['1'],
					"hexcode" => $data['2']
				]);
            }
            $firstline = false;
		}

		fclose($csvFile);
    }
}
