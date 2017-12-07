<?php

namespace App;

use App\Utilities\RedisScoreWrapper;

class Trending extends RedisScoreWrapper
{
    public function push($award, $score = 1)
    {
        parent::push($award->toCache(), $score);
    }

    public function cacheKey()
    {
        $this->cacheKey = 'trending_awards';
        return parent::cacheKey();
    }

    public function get($start = 0, $end = 4, $flags = []) {
        return array_map('json_decode', parent::get($start, $end, $flags));
    }

}
