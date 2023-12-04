<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$role_admin = Role::where('name', 'admin')->first();

        $role_user = Role::where('name', 'user')->first();

		$admin = new User;
		$admin->name = "Josh";
		$admin->email = "N00221586@iadt.ie";
		$admin->password = Hash::make("root");
		$admin->save();	

        $admin->roles()->attach($role_admin);

        $user = new User;
        $user->name = "Geoff Keighly";
        $user->email = "hello@thegameawards.com";
        $user->password = "frogger2";
        $user->save();

        $user->roles()->attach($role_user);
    }
}
