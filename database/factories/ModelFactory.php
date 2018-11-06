<?php

use Faker\Generator as Faker;
use App\Link;
use App\Comment;

$factory->define(Link::class, function (Faker $faker) {
    static $number = 0;
    return [
        'id' => $number++,
        'title' => $faker->sentence,
        'url' => $faker->url,
        'description' => $faker->text,
        'user_id' => function() {
            return factory('App\User')->create()->id;
        }
    ];
});


$factory->define(App\User::class, function (Faker $faker) {
    static $number = 0;
    return [      
        'id' => $number++,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(Comment::class, function (Faker $faker) {
    static $number = 0;
    return [
        'id' => $number++,
        'parent_id' => Null,
        'body' => 'Comment',
        'commentable_id' => function() {
            return factory('App\Link')->create()->id;
        },
        'commentable_type' => 'App\Link',
    ];
});
