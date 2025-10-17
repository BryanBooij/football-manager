<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/players', [PlayerController::class, 'index']);
Route::get('/players/country/{id}', [PlayerController::class, 'filterByCountry']);

Route::get('/about', function() {
    return view('about');
});

Route::get('/contact', function() {
    return view('contact');
});

Route::get('/test', function() {
    return view('test');
})->name('test');

Route::post("/test", function() {
    request()->validate([
        'name' => 'required',
        'country' => 'required',
    ]);
    dd(request()->all());
});

Route::get('/team', function() {
    return view('teams.team');
});

Route::get('/blogs', [BlogController::class, 'index']);

require __DIR__.'/auth.php';
