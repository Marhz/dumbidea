<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Redis;

abstract class RedisScoreWrapper
{
    protected $cacheKey = "";

    public function push($model, $score = 1)
    {
        Redis::zincrby($this->cacheKey(), $score, json_encode($model));
    }

    public function get($start = 0, $end = 4, $flags = [])
    {
        return array_map('json_decode', $this->getRaw($start, $end, ...$flags));
    }

    public function getWithScores($start = 0, $end = 4)
    {
        $trending = $this->getRaw($start, $end, ['WITHSCORES']);
        return array_map(function ($item, $score) {
            $item = json_decode($item);
            $item->_score = $score;
            return $item;
        }, array_keys($trending), $trending);
    }

    public function getRaw($start = 0, $end = 4, $flags = [])
    {
        return Redis::zrevrange($this->cacheKey(), $start, $end, ...$flags);
    }

    public function cacheKey()
    {
        return app()->environment('testing') ? 'testing_' . $this->cacheKey : $this->cacheKey;
    }

    public function reset()
    {
        Redis::del($this->cacheKey());
    }
}
