<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Award;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function upvote(Award $award)
    {
        $vote = $award->votes()->where('user_id', auth()->id())->first();
        if ($vote) {
            if ($vote->pivot->value == 1) {
                $award->votes()->detach(auth()->id());
            }
            else {
                $award->votes()->updateExistingPivot(auth()->id(), ['value' => 1]);
            }
        }
        else {
            $award->votes()->attach(auth()->id(), ['value' => 1]);
        }
    }

    public function downvote(Award $award)
    {
        $vote = $award->votes()->where('user_id', auth()->id())->first();
        if ($vote) {
            if ($vote->pivot->value == -1) {
                $award->votes()->detach(auth()->id());
            }
            else {
                $award->votes()->updateExistingPivot(auth()->id(), ['value' => -1]);                
            }
        }
        else {
            $award->votes()->attach(auth()->id(), ['value' => -1]);            
        }        
    }
}
