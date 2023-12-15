<?php

use App\Http\Controllers\Admin\CustomPokemonController as AdminCustomPokemonController;
use App\Http\Controllers\User\CustomPokemonController as UserCustomPokemonController;
use App\Http\Controllers\User\TeamController as UserTeamController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\MoveController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
		
	Route::resource('/pokemon', PokemonController::class);
	Route::resource('/moves', MoveController::class);

	Route::resource('/teams', UserTeamController::class);
	
});

Route::resource('/admin/teams', AdminTeamController::class)->middleware(['auth'])->names('admin.teams');
/*
The admins can see every custom pokemon
The users can only see their own - per user is already made


*/
Route::resource('/admin/custom', AdminCustomPokemonController::class)->middleware(['auth'])->names('admin.custom');

Route::resource('/custom', UserCustomPokemonController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

require __DIR__.'/auth.php';
