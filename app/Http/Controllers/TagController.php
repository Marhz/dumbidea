<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Award;

class TagController extends Controller
{
    public function show(Request $request, Tag $tag)
    {
        $awards = $tag->awards()->with('owner','tags', 'votes')
            ->paginate();
        return view('awards.index', [
            'tag' => $tag,
            'awards' => $awards
        ]);
    }
}
