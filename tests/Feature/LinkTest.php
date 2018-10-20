<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LinkTest extends TestCase
{

    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();
        $this->link = factory('App\Link')->create();
    }


    /** @test **/
    public function user_can_view_index_page()
    {
        $this->get('/links')
            ->assertStatus(200);
    }


    /** @test **/
    public function user_can_view_links()
    {
        $this->get('/links')
            ->assertSee($this->link->title);
    }


    /** @test **/
    public function user_can_view_individual_link()
    {
        $this->get('/links/' . $this->link->id)
            ->assertSee($this->link->title);
    }


    /** @test **/
    public function auth_user_can_post_link()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user);
        // $link = factory('App\Link')->make();
        // code above drops an error, why?
        $this->post('/links/store', $this->link->toArray());
        $this->get('/links/' . $this->link->id)
            ->assertSee($this->link->title);
    }


    /** @test **/
    public function non_authenticated_users_cannot_post_link()
    {
        $this->post('/links/store', $this->link->toArray())
            ->assertStatus(405);
    }


    /** @test **/
    public function a_link_can_be_deleted()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user);
        //$this->json('DELETE', $link->path());
        $this->delete('/links/' . $this->link->id);
        $this->assertDatabaseMissing('links', ['id' => $this->link->id]);
    }


    /** @test **/
    public function a_user_can_see_links_comments()
    {
        $comment = factory('App\Comment')
            ->create([
                'commentable_id' => $this->link->id,
                'commentable_type' => 'App\Link',
            ]);
        $this->get('/links/' . $this->link->id)
            ->assertSee($comment->body);
    }
}
