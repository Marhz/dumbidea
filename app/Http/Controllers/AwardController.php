<?php
namespace App\Http\Controllers;

use App\Award;
use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\StoreAwardRequest;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = Award::with('votes', 'owner', 'tags')->paginate();
        return view('awards.index', compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all()->pluck('name');
        return view('awards.create', compact('tags', 'tagsSelect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAwardRequest $request)
    {
        $award = Award::create([
            'title' => request('title'),
            'image' => request()->file('image')->store('awards', 'public'),
            'user_id' => auth()->id()
        ]);
        $award->syncTags($request->get('tags'));
        return redirect(route('awards.show', ['id' => $award->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        $award->load('owner', 'votes', 'tags');
        return view('awards.show', compact('award'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Award $award)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Award $award)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        //
    }
}
