<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;

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
        //if search field is empty return error message
        if (empty($player_search)) {
            return redirect()->back()->with('error', 'Please enter a player name.');
        }
        // search for player in database
        $players = Player::where('name', 'like', '%' . $player_search . '%')->paginate(10);
        // if player not found in database $players===0 return error message
        if ($players->total() === 0) {
            return redirect()->back()->with('error', 'Player doesn’t exist.');
        }

        return view('players.index', compact('players', 'countries', 'currentCountry'));
    }

    public function destroy(Player $player)
    {
        $team = auth()->user()->team;

        $team->players()->detach($player->id);

        return redirect()->back()->with('success', 'Player removed from team.');
    }

    public function create()
    {
        $currentCountry = null;
        $countries = Country::all();
        return view('players.index', compact('countries', 'currentCountry'));
    }

    public function store(Request $request)
    {
        Player::create();

        return redirect()->route('players.index')->with('success', 'Player added!');
    }

    public function addPlayerToTeam($playerId)
    {
        $team = auth()->user()->team;

        if ($team->players()->where('player_id', $playerId)->exists()) {
            return back()->with('error', 'This player is already in the team.');
        }

        if (!$team) {
            return redirect()->back()->with('error', 'You have no team.');
        }

        if (!$team->users()->where('speler_id', $playerId)->exists()) {
            $team->users()->attach($playerId);
        }

        return redirect()->back()->with('success', 'Player added to your team!');
    }

}


