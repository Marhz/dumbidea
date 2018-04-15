<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
    protected $appends = [
      'path'  
    ];
    
    public static function boot()
    {
        parent::boot();
        static::creating(function($tag) {
            $tag->slug = $tag->name;
        });
    }
    public function getPathAttribute()
    {
        return route("tag.show", ['tag' => $this->id]);
    }

    public function awards()
    {
        return $this->belongsToMany(Award::class);
    }

    public function toCache()
    {
        return [
            'name' => $this->name,
            'path' => $this->path()
        ];
    }
}
