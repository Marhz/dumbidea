<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\PopularTags;

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

    public static function boot()
    {
        parent::boot();
        static::created(function ($award) {
            $key = app()->environment('testing') ? 'testing_awards_list' : 'awards_list';
            Redis::lpush($key, json_encode($award->toCache()));
        });
    }

    public function path()
    {
        return route('awards.show', ['award' => $this->id]);
    }

    public function syncTags($tags)
    {
        $popularTags = new PopularTags();
        $tagsId = [];
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $tagsId[] = $tag->id;
            $popularTags->push($tag);
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

    public function wasCreatedToday()
    {
        return Carbon::now()->lt($this->created_at->startOfDay()->addDay());
        // return $this->created_at->gt(Carbon::now()->subDay());
    }

    public function toCache()
    {
        return [
            'title' => $this->title,
            'image' => $this->image,
            'path' => $this->path()
        ];
    }

    public function getImageAttribute($image)
    {
        return $this->attributes['image'] = asset($image);
    }
}
