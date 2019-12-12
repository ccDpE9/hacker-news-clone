<?php

use Faker/Generator as Faker;

// --- Comment
$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'parent_id' => Null,
        'body' => 'Comment',
        'commentable_id' => function() {
            return factory('App\Link')->create()->id;
        },
        'commentable_type' => 'App\Link',
    ];
});
