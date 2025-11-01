<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\UserLogin;

class CommentController extends Controller
{
    public function store(Request $request, $teamId)
    {
        $user = auth()->user();
        $loginCount = $user->loginTracker?->login_count ?? 0;

        if ($loginCount < 5) {
            return redirect()->back()->with('error', 'You must login at least 5 times to use the comment feature');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'team_id' => $teamId,
            'user_id' => $user->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Comment posted!');
    }
}

