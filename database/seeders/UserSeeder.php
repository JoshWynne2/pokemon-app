<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$admin = new User;
		$admin->name = "Josh";
		$admin->email = "N00221586@iadt.ie";
		$admin->password = Hash::make("root");
		$admin->save();	
    }
}
