<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function show(Request $request, Tag $tag)
    {
        $tag->load('awards');
        return view('awards.index', [
            'tag' => $tag,
            'awards' => $tag->awards
        ]);
    }
}
