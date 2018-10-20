<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentTest extends TestCase
{

    use DatabaseMigrations;

    /** @test **/
    function comment_has_an_owner()
    {
        $comment = factory('App\Comment')->create([
            'commentable_id' => 1,
            'commentable_type' => 'App\Link',
        ]);
        $this->assertInstanceOf('App\User', $comment->user);
    }

}
