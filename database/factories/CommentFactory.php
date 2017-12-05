<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text,
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'award_id' => function () {
            return factory('App\Award')->create()->id;
        }
    ];
});
