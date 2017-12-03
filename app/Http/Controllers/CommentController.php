<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Award;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function index($awardId)
    {
        $comments = Comment::where('award_id', $awardId)->get();
        return $comments;
    }

    public function store(Request $request, Award $award)
    {
        $request->validate([
            'content' => ['required']
        ]);
        $comment = Comment::create([
            'content' => $request->get('content'),
            'user_id' => auth()->id(),
            'award_id' => $award->id
        ]);
        return $comment;
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => ['required']
        ]);
        $this->authorize('update', $comment);
        $comment->update([
            'content' => $request->get('content')
        ]);
        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->delete();
    }
}
