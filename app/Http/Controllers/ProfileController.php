<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function show($user = null)
    {
        if ($user === null && auth()->guest())
            abort(403);
        $user = ($user === null) ? auth()->user() : User::findOrFail($user);
        $user->load(['awards.votes', 'awards.commentsCount', 'awardsVotes' => function ($query) {
            return $query->where('value', 1);
        }, 'comments.award', 'comments.votes']);
        return view('profile.show', [
            'user' => $user,
            'awards' => $user->awards,
            'comments' => $user->comments,
            'awardsVotes' => $user->awardsVotes,
            'commentsVotes' => $user->commentsVotes
        ]);
    }
}
