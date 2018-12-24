<?php

use Faker\Generator as Faker;
use App\User;
use App\Link;
use App\Comment;


$factory->define(User::class, function (Faker $faker) {
    return [      
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


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


$factory->define(Upvote::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'link_id' => function() {
            return factory('App\Link')->create()->id;
        }
    ];
});
