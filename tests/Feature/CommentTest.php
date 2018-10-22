<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    
    public function setUp()
    {
        parent::setUp();
        $this->link = factory('App\Link')->create();
    }


    /** @test **/
    public function auth_user_can_post_comment()
    {
        $this->signIn();
        $comment = factory('App\Comment')
            ->create([
                'commentable_id' => $this->link->id,
                'commentable_type' => 'App\Link',
            ]);
        $this->post('/comments', $comment);
        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
    }
}
