<?php

use Faker\Generator as Faker;
use App\Link;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'id' => 0,
        'title' => 'Test',
        'url' => 'www.google.com',
        'description' => 'Testing',
        'user_id' => 0,
    ];
});
