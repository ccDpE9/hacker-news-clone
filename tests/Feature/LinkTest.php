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
        $this->user = factory('App\User')->create();
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
    public function index_page_shows_all_links()
    {
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
        $this->signIn();
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


    /** @test **/
    public function a_link_requires_a_title()
    {
        $this->publishLink(['title' => ''])
             ->assertSessionHasErrors('title');
    }


    /** @test **/
    public function a_links_title_should_not_be_too_long()
    {
        $response = $this->publishLink([
            'title' => str_repeat('a', 56),
        ])->assertSessionHasErrors(['title']);
    }


    /** @test **/
    public function a_links_title_is_long_enough()
    {
        $response = $this->publishLink([
            'title' => str_repeat('a', 55),
            'url' => 'www.google.com',
            'user_id' => $this->user->id,
        ]);
        $this->assertDatabaseHas('links', [
            'title' => str_repeat('a', 55),
        ]);
        // used 302 because i redirect in LinkController
        $response->assertStatus(302);
    }


    /** @test **/
    public function a_link_requires_a_url()
    {
        $this->publishLink(['url' => null])
             ->assertSessionHasErrors('url');;
    }


    public function publishLink($data)
    {
        $this->signIn();
        $link = make('App\Link', $data);
        $response = $this->post(route('links.store'), $link->toArray());
        return $response;
    }

    // ASSERT THAT THE BASEURL() RETURNS URL AND NOT JUST A RONDOM STRING
    
}
