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

        if ($team && ! $team->active) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Your team is inactive and cannot be viewed');
        }

        return view('teams.team', compact('team'));
    }

    public function allTeams(){
        $user = auth()->user();

        if ($user->isAdmin()) {
            $teams = Team::with('players')->get();
        } else {
            $teams = Team::with('players')->where('active', true)->get();
        }

        return view('teams.allteams', compact('teams'));
    }

    public function show(Team $team)
    {
        $team->load('players');

        return view('teams.team', compact('team'));
    }

    public function toggleStatus(Team $team)
    {
        $team->active = ! $team->active;
        $team->save();

        // ajax response nodig voor pagina refresh
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'status'  => $team->active,
            ]);
        }

        return redirect()->back();
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Team::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Team created successfully!');
    }

    public function destroy(Team $team)
    {
        // gebruiker of admin kan team verwijderen
        if ($team->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $team->players()->detach();

        $team->delete();

        return redirect()->back()->with('success', 'Team deleted successfully!');
    }

}
