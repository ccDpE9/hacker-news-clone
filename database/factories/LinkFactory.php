<?php

use Faker\Generator as Faker;
use App\User;
use App\Link;
use App\Comment;

$factory->define(Link::class, function (Faker $faker) {
    $title = $faker->sentence($nbWords=4, $variableNbWords=true);
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'url' => $faker->url,
        'description' => $faker->text,
        'user_id' => function() {
            return factory('App\User')->create()->id;
        }
    ];
});


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
