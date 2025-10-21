<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
//    public function addPlayersToTeam(Request $request, TeamController $team)
//    {
//        $playerIds = $request->input('player_ids');
//
//        $team->users()->syncWithoutDetaching($playerIds);
//
//        return redirect()->back()->with('success', 'Spelers toegevoegd aan het team!');
//    }

    public function myTeam()
    {
        $user = auth()->user();
        $team = $user->team()->with('players')->first();

        return view('teams.team', compact('team'));
    }

}
