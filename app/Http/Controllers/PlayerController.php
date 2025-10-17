<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Country;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::with('country')->get();
        $countries = Country::all();
        $currentCountry = null;

        return view('players.index', compact('players', 'countries', 'currentCountry'));
    }

    public function filterByCountry($id)
    {
        $countries = Country::all();
        $players = Player::with('country')->where('country_id', $id)->get();

        $currentCountry = $countries->firstWhere('id', $id);

        return view('players.index', compact('players', 'countries', 'currentCountry'));
    }
}


