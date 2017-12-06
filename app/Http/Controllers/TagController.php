<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Award;

class TagController extends Controller
{
    public function show(Request $request, Tag $tag)
    {
        $awards = Award::with('owner','tags', 'votes')
            ->whereIn('id', $tag->awards->pluck('id'))
            ->paginate();
        return view('awards.index', [
            'tag' => $tag,
            'awards' => $awards
        ]);
    }
}
