<?php

namespace App;

use App\Utilities\RedisScoreWrapper;

class Trending extends RedisScoreWrapper
{
    const VISIT_VALUE = 1;
    const COMMENT_VALUE = 2;
    
    public function push($award, $score = 1)
    {
        parent::push($award->toCache(), $score);
    }

    public function cacheKey()
    {
        $this->cacheKey = 'trending_awards';
        return parent::cacheKey();
    }
}
