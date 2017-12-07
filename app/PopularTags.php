<?php
namespace App;

use App\Utilities\RedisScoreWrapper;

class PopularTags extends RedisScoreWrapper
{
    public function push($tag, $score = 1)
    {
        parent::push($tag->toCache(), $score);
    }

    public function get($start = 0, $end = 4, $flags = [])
    {
        $scores = parent::get($start, $end, ['WITHSCORES']);
        return array_map(function($score, $key) {
            $key = json_decode($key);
            $key->score = $score;
            return $key;
        }, $scores, array_keys($scores));
    }

    public function cacheKey()
    {
        $this->cacheKey = 'popular_tags';
        return parent::cacheKey();
    }
}
