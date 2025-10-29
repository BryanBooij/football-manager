<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function myTeam()
    {
        $user = auth()->user();
        $team = $user->team()->with('players')->first();

        return view('teams.team', compact('team'));
    }

    public function allTeams(){
        $teams = Team::with('players')->get();

        return view('teams.allteams', compact('teams'));
    }

    public function show(Team $team)
    {
        $team->load('players');

        return view('teams.show', compact('team'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team = \App\Models\Team::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Team created successfully!');
    }

    public function destroy(Team $team)
    {
        if ($team->user_id !== auth()->id()) {
            abort(403);
        }

        $team->players()->detach();

        $team->delete();

        return redirect()->back()->with('success', 'Team deleted successfully!');
    }

}
