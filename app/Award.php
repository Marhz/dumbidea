<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use Voteable;

	protected $guarded = [];
    protected $with = ['tags'];
    protected $appends = [
        'path',
        'user_vote'
    ];

    public function path()
    {
        return route('awards.show', ['award' => $this->id]);
    }

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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getPathAttribute()
    {
        return $this->attributes['path'] = $this->path();
    }
}
