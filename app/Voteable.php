<?php

namespace App;

trait Voteable
{
    protected $upvoteValue = 1;
    protected $downvoteValue = -1;

    public function votes()
    {
        return $this->morphToMany(User::class, 'vote', 'votes')->withPivot(['value']);
    }

    public function getUserVoteAttribute()
    {
        if (auth()->guest() || !$vote = $this->votes()->where('user_id', auth()->id())->first()) {
            return $this->attributes['user_vote'] = null;
        }
        return $this->attributes['user_vote'] = $vote->pivot->value > 0;
    }

    public function upvote()
    {
        $this->vote($this->upvoteValue);
    }

    public function downvote()
    {
        $this->vote($this->downvoteValue);
    }

    protected function vote($value) {
        $vote = $this->votes()->where('user_id', auth()->id())->first();
        if ($vote) {
            if ($vote->pivot->value == $value) {
                $this->votes()->detach(auth()->id());
            } else {
                $this->votes()->updateExistingPivot(auth()->id(), ['value' => $value]);
            }
        } else {
            $this->votes()->attach(auth()->id(), ['value' => $value]);
        }
    }

    public function totalUpvotes()
    {
        return $this->votes()->wherePivot('value', $this->upvoteValue)->count();
    }

    public function totalDownvotes()
    {
        return $this->votes()->wherePivot('value', $this->downvoteValue)->count();
    }

    public function totalVotes()
    {
        return $this->votes()->count();
    }
}
