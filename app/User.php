<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
        return $this->lastAward->created_at->startOfDay()->addDay()->timestamp;
    }

    public function canPostAward()
    {
        return ! $this->lastAward->wasCreatedToday();
    }
}
