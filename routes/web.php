<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// player routes for player CRUD
Route::resource('players', PlayerController::class);
Route::get('/players/country/{id}', [PlayerController::class, 'filterByCountry']);
Route::get('player_search', [PlayerController::class, 'player_search'])->name('player_search');
Route::get('player_search_by_country/{country}', [PlayerController::class, 'searchByCountry'])->name('player.searchByCountry');
Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
Route::post('/players', [PlayerController::class, 'store'])->name('players.store');
Route::post('/team/add-player/{playerId}', [PlayerController::class, 'addPlayerToTeam'])->name('team.add-player');

// team routes for team delete and create
Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');
Route::get('/my-team', [TeamController::class, 'myTeam'])->middleware('auth')->name('my.team');

// admin can view all teams from users protected by middleware
Route::get('/allteams', [TeamController::class, 'allTeams'])->middleware('auth')->name('all.teams');
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show')->middleware('auth');
Route::post('/teams/{team}/toggle-status', [TeamController::class, 'toggleStatus'])->name('teams.toggleStatus')->middleware('auth', 'is_admin');


Route::get('/about', function() {
    return view('about');
});

Route::get('/contact', function() {
    return view('contact');
});

Route::get('/test', function() {
    return view('test');
})->name('test')->middleware('auth', 'is_admin'); ;

Route::post("/test", function() {
    request()->validate([
        'name' => 'required',
        'country' => 'required',
    ]);
    dd(request()->all());
});

Route::get('/blogs', [BlogController::class, 'index']);

require __DIR__.'/auth.php';
