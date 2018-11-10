<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\DustTestCase;
use Laravel\Dusk\Chrome;


class LinkTest extends TestCase
{

    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();
        $this->link = create('App\Link');
        $this->user = create('App\User');

    }


    // --- INDEX --- //


    /** @test **/
    function user_can_view_index_page()
    {
        $this->get(route('links.index'))
            ->assertStatus(200);
    }

    /** @test **/
    function index_page_returns_single_link()
    {
        $this->get(route('links.index'))
            ->assertSee($this->link->title);
    }

    /** @test **/
    function index_page_shows_all_links()
    {
        $link1 = create('App\Link');
        $link2 = create('App\Link');
        $response = $this->get(route('links.index'));
        $response->assertStatus(200);
        $response->assertSee($link1->title);
        $response->assertSee($link2->title);
    }


    // --- SHOW --- //


    /** @test **/
    function show_view_returns_404_when_link_not_found()
    {
        $this->get('/links/' . 404)
             ->assertStatus(404);
    }

    /** @test **/
    function show_page_returns_single_link()
    {
        $this->get(route('links.show', $this->link))
             ->assertSee($this->link->title);
    }


    // --- CREATE --- //
    
    /** @test **/
    function unauthenticated_users_cannot_access_create_view()
    {
        $this->get(route('links.create'))
             ->assertRedirect(route('login'));
    }


    // --- STORE --- //

    /** @test **/
    function auth_user_can_post_link()
    {
        $link = create('App\Link', [
            'user_id' => $this->user->id,
        ]);
        $this->withoutExceptionHandling();
        $this->get(route('links.show', $link))
            ->assertSee($link->title);
    }


    // --- UPDATE --- //

    /** @test **/
    function authorized_users_can_update_links()
    {
        $this->signIn($this->user);
        $link = create('App\Link', [
            'user_id' => $this->user->id
        ]);
        $this->put(route('links.update', $link))
            ->assertStatus(302); 
    }



    // --- DESTROY --- //

    /** @test **/
    function non_authenticated_users_cannot_access_delete_view()
    {
        $this->delete(route('links.show', $this->link))
            ->assertRedirect(route('login'));
    }


    /** @test **/
    function authorized_users_may_delete_links()
    {
        $this->signIn($this->user);
        $link = create('App\Link', [
            'user_id' => $this->user->id,
        ]);
        $this->delete(route('links.show', $link))
            ->assertStatus(302);
    }


    /** @test **/
    function unauthorized_users_may_not_delete_links()
    {
        $this->signIn();
        $this->delete(route('links.show', $this->link))
            ->assertStatus(403);
    }


    // --- VALIDATION --- //


    /** @test **/
    function link_must_have_a_title()
    {
        $this->publishLink(['title' => null])
            ->assertSessionHasErrors('title');
    }


    /** @test **/
    function a_links_title_should_not_be_too_long()
    {
        $response = $this->publishLink([
            'title' => str_repeat('a', 56),
        ])->assertSessionHasErrors(['title']);
    }


    /** @test **/
    function a_links_title_is_long_enough()
    {
        $response = $this->publishLink([
            'title' => str_repeat('a', 55),
        ]);
        $this->assertDatabaseHas('links', [
            'title' => str_repeat('a', 55),
        ]);
        // used 302 because i redirect in LinkController
        $response->assertStatus(302);
    }


    /** @test **/
    function link_must_have_a_user()
    {
        $this->publishLink(['user_id' => null])
            ->assertSessionHasErrors();
    }


    /** @test **/
    function a_link_must_have_a_url()
    {
        $this->publishLink(['url' => null])
             ->assertSessionHasErrors('url');;
    }


    /** @test **/
    function a_link_requires_valid_url()
    {
        collect([
            'test.com',
            'test',
            'test.com+org'
        ])->each(function ($invalidUrl) {
            $this->publishLink([
                'title' => 'Test',
                'url' => $invalidUrl
            ])->assertSessionHasErrors([
                'url'
            ]);
        });
    }


    /** @test **/
    function two_links_wont_have_a_same_slug_even_if_their_titles_are_the_same()
    {
        $link1 = create('App\Link', [
            'title' => 'test',
        ]);
        $link2 = create('App\Link', [
            'title' => 'test',
        ]);
        $this->assertNotEquals($link1->slug, $link2->slug);
    }


    function publishLink($data)
    {
        $this->signIn();
        $link = make('App\Link', $data);
        return $this->post(route('links.store'), $link->toArray());
    }


    // --- LINK-COMMENT RELATION ---///


    /** @test **/
    function if_link_is_deleted_its_comments_are_deleted_too()
    {
        $this->signIn($this->user);
        $link = create('App\Link', [
            'user_id' => $this->user->id
        ]);
        $comment = create('App\Comment', [
            'commentable_id' => $link->id
        ]);
        $this->delete(route('links.show', $link));
        $this->assertDatabaseMissing('comments', $comment->toArray());
    }


    /** @test **/
    function show_page_includes_links_comments()
    {
        $comment = create('App\Comment', [
                'commentable_id' => $this->link->id,
                'commentable_type' => 'App\Link',
        ]);
        $this->get(route('links.show', $this->link))
            ->assertSee($comment->body);
    }
} 
