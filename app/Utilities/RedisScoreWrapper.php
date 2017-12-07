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
