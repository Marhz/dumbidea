<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();
        static::creating(function($tag) {
            $tag->slug = $tag->name;
        });
    }
    public function path()
    {
        return route("tag.show", ['tag' => $this->id]);
    }

    public function awards()
    {
        return $this->belongsToMany(Award::class);
    }
}