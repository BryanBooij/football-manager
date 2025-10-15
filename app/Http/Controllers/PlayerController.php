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

        return view('players.index', compact('players', 'countries'));
    }

    public function filterByCountry($id)
    {
        $countries = Country::all();
        $players = Player::with('country')->where('country_id', $id)->get();

        return view('players.index', compact('players', 'countries'));
    }
}


