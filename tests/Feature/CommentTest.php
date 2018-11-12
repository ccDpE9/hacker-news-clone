<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentTest extends TestCase
{

    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();
        $this->link = create('App\Link');
        // $this->user = create('App\User');
    }


    // --- STORE -- //

    /** @test **/
    public function authenticated_user_can_post_comment()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $comment = [
            'body' => 'This is just so i can assertDatabaseHas',
            'link_id' => $this->link->id
        ];
        $this->post(route('comments.store', $comment))
            ->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'body' => $comment['body'],
            'commentable_id' => $comment['link_id']
        ]);
    }

    /** @test **/
    public function authenticated_user_can_post_a_reply()
    {
        $this->signIn();
        $comment = create('App\Comment');
        $reply = [
            'body' => 'Comment',
            'comment_id' => 1,
            'link_id' => 2
        ];
        $this->post(route('reply.store', $reply))
            ->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'body' => $reply['body'],
            'parent_id' => $comment->id
        ]);
    }

    /** @test **/
    public function unauthenticated_user_cannot_post_a_comment()
    {
        $comment = [
            'body' => 'This is just so i can assertDatabaseHas',
            'link_id' => $this->link->id
        ];
        $this->post(route('comments.store', $comment))
             ->assertStatus(302)
             ->assertRedirect(route('login'));
        $this->assertDatabaseMissing('comments', [
            'body' => $comment['body'],
            'commentable_id' => $comment['link_id']
        ]);
    }


    /** @test **/
    public function unauthenticated_user_cannot_post_a_reply()
    {
        $comment = create('App\Comment');
        $reply = [
            'body' => 'This is just so i can assertDatabaseHas',
            'link_id' => 2,
            'comment_id' => $comment->id
        ];
        $this->post(route('comments.store', $comment))
             ->assertStatus(302)
             ->assertRedirect(route('login'));
        $this->assertDatabaseMissing('comments', [
            'body' => $comment['body'],
            'commentable_id' => $comment['link_id']
        ]);
    }


    // --- VALIDATION --- //
    
    /** @test **/
    public function body_is_required()
    {
        $this->signIn();
        $comment = [
            'link_id' => 2
        ];
        $this->post(route('comments.store', $comment))
            ->assertSessionHasErrors('body');
    }

    /** @test **/
    public function link_id_field_is_required_on_comment_submission()
    {
        $this->signIn();
        $comment = [
            'body' => 'Comment'
        ];
        $this->post(route('comments.store', $comment))
            ->assertSessionHasErrors('link_id');
    }   


    /** @test **/
    public function link_id_must_be_an_integer()
    {
        $this->signIn();
        $comment = [
            'body' => 'Comment',
            'link_id' => 'Must be an integer'
        ];
        $this->post(route('comments.store', $comment))
            ->assertSessionHasErrors('link_id');
    }

}
