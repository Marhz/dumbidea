<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Lang;

class ProfileController extends Controller
{
    public function show($user = null)
    {
        if ($user === null && auth()->guest())
            return redirect('login')->with('flash', [
                'message' => Lang::get('redirect.login'), 
                'level' => 'warning'
            ]);
        $user = ($user === null) ? auth()->user() : User::findOrFail($user);
        $awards = $user->awards()->with(['votes', 'commentsCount'])->paginate(null, ['*'], 'awardsPage');
        $comments = $user->comments()->with('award', 'votes')->paginate(null, ['*'], 'commentsPage');
        $awardsVotes = $user->awardsVotes()->where('value', 1)->paginate(null, ['*'], 'upvotesPage');
        return view('profile.show', compact(
            'user',
            'awards',
            'comments',
            'awardsVotes'
        ));
    }
}
