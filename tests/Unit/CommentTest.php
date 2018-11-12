<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentTest extends TestCase
{

    use DatabaseMigrations;

    protected $comment;

    public function setUp()
    {
        parent::setUp();
        $this->comment = create('App\Comment');
    }


    /** @test **/
    function comment_has_an_owner()
    {
        $comment = create('App\Comment');
        $this->assertInstanceOf(
            'App\User', 
            $comment->user
        );
    }


    /** @test **/
    public function comment_has_a_reply_and_multiple_replies()
    {
        $reply = create('App\Comment', [
            'commentable_id' => $this->comment->id,
            'commentable_type' => 'App\Comment'
        ]);
        $this->assertInstanceOf(
            'App\Comment', 
            $reply->commentable
        );
        create('App\Comment', [
            'commentable_id' => $reply->id,
            'commentable_type' => 'App\Comment'
        ]);
        create('App\Comment', [
            'commentable_id' => $reply->id,
            'commentable_type' => 'App\Comment',
        ]);
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $reply->replies
        );
    }

    
}
