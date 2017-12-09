<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['avatar'];

    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsVotes()
    {
        return $this->morphedByMany(Comment::class, 'vote', 'votes');
    }

    public function awardsVotes()
    {
        return $this->morphedByMany(Award::class, 'vote', 'votes');
    }

    public function lastAward()
    {
        return $this->hasOne(Award::class)->latest()->limit(1);
    }

    public function nextAvailableAward()
    {
        if ($this->lastAward == null)
            return Carbon::now()->timestamp;
        return $this->lastAward->created_at->startOfDay()->addDay()->timestamp;
    }

    public function canPostAward()
    {
        return isset($this->lastAward) && ! $this->lastAward->wasCreatedToday();
    }

    public function isAdmin()
    {
        return $this->email === "test@mail.com";
    }

    public function getAvatarAttribute()
    {
        return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=retro&s=64";
    }
}
