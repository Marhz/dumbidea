<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    protected $with = ['author'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getContentAttribute()
    {
        return $this->attributes['content'] = nl2br($this->attributes['content']);;
    }
}
