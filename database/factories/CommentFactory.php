<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'id' => 0,
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'parent_id' => Null,
        'body' => 'Test',
    ];
});
