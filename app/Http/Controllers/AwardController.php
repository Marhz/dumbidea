<?php
namespace App\Http\Controllers;

use App\Award;
use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\StoreAwardRequest;
use App\Trending;
use Intervention\Image\Facades\Image;

class AwardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = Award::with('votes', 'owner', 'tags')->latest()->paginate();
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
        $image = $this->makeImage();
        $award = Award::create([
            'title' => request('title'),
            'image' => $image,
            'user_id' => auth()->id()
        ]);
        $award->syncTags($request->get('tags') ?? []);
        return redirect(route('awards.show', ['id' => $award->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award, Trending $trending)
    {
        $award->load('owner', 'votes', 'tags');
        $trending->push($award);
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

    protected function makeImage()
    {
        $image = Image::make(request()->file('image'));
        $path = '/home/georges/sites/dumbidea/public/storage/awards/';
        $path = storage_path('app/public/awards/');
        $ext = '.' . request()->file('image')->getClientOriginalExtension();
        $hash = md5($image . time());
        $fullPath = $path . $hash . $ext;
        $image->save($fullPath);
        $image->fit(260, 200)->save($path . $hash . '_thumbnail' . $ext);
        return 'storage/awards/' . $hash . $ext;
    }
}
