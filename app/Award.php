<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use Voteable;

	protected $guarded = [];
    protected $with = [];
    protected $appends = [
        'path',
        'user_vote',
        'score'
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

    public function commentsCount()
    {
        return $this->hasOne(Comment::class)
            ->selectRaw('award_id, count(*) as aggregate')
            ->groupBy('award_id');
    }
    public function getCommentsCountAttribute()
    {
     // if relation is not loaded already, let's do it first
        if (!array_key_exists('commentsCount', $this->relations))
            $this->load('commentsCount');

        $related = $this->getRelation('commentsCount');
 
      // then return the count directly
        return ($related) ? (int)$related->aggregate : 0;
    }
}
