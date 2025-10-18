<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Country;
use Illuminate\Http\Request;

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

    public function player_search(Request $request)
    {
        $countries = Country::all();
        $currentCountry = null;
        $player_search = $request->search;
        $players = Player::where('name', 'like', '%' . $player_search . '%')->paginate(10);

        return view('players.index', compact('players', 'countries', 'currentCountry'));
    }
}


