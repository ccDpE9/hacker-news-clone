<?php

use Faker\Generator as Faker;
use App\Link;

$factory->define(Link::class, function (Faker $faker) {
    static $number = 0;
    $user = factory('App\User')->create();
    return [
        'id' => $number++,
        'title' => $faker->sentence,
        'url' => $faker->url,
        'description' => $faker->text,
        'user_id' => $user->id,
    ];
});
