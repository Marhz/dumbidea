<?php

use Faker\Generator as Faker;

$factory->define('App\Award', function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'image' => "http://via.placeholder.com/450x600",
        'user_id' => factory('App\User')->create()->id
    ];
});
