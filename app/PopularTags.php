<?php
namespace App;

use App\Utilities\RedisScoreWrapper;

class PopularTags extends RedisScoreWrapper
{
    public function push($tag, $score = 1)
    {
        parent::push($tag->toCache(), $score);
    }

    public function cacheKey()
    {
        $this->cacheKey = 'popular_tags';
        return parent::cacheKey();
    }
}
