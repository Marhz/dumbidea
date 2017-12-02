<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
	protected $guarded = [];
    protected $with = ['tags'];

    public function syncTags($tags)
    {
        $tagsId = [];
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $tagsId[] = $tag->id;
        }
        $this->tags()->sync($tagsId);
    }

    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
