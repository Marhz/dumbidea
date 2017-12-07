<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Carbon;

class PostTooOftenException extends Exception
{
    public function render()
    {
        $date = auth()->user()->nextAvailableAward();
        return redirect()->back()->with('flash', [
            'message' => 'You need to wait until tommorow to post a new award', 
            'level' => 'danger'
        ]);
    }
}
