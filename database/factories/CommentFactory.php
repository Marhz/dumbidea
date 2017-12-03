<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text,
        'user_id' => factory('App\User')->create()->id,
        'award_id' => factory('App\Award')->create()->id
    ];
});
