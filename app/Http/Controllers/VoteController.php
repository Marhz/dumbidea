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
    
    public function upvote($model, $id)
    {
        $model = 'App\\' . ucfirst(str_singular($model));
        return $model::findOrFail($id)->upvote();
    }

    public function downvote($model, $id)
    {
        $model = 'App\\' . ucfirst(str_singular($model));
        return $model::findOrFail($id)->downvote();
    }
}
