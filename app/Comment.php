<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Voteable;

class Comment extends Model
{
    use Voteable;

    protected $guarded = [];
    // protected $with = [
    //     'author',
    // ];
    protected $appends = ['', 'score'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function award()
    {
        return $this->belongsTo(Award::class);
    }

    public function getContentAttribute()
    {
        return $this->attributes['content'] = nl2br($this->attributes['content']);;
    }

    public function path()
    {
        return $this->award->path() . "comment-". $this->id;
    }
}
