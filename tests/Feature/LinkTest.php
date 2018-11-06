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


    /** @test **/
    function user_can_view_index_page()
    {
        // $this->withoutExceptionHandling();
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
        $link1 = factory('App\Link')->create();
        $link2 = factory('App\Link')->create();
        $response = $this->get(route('links.index'));
        $response->assertStatus(200);
        $response->assertSee($link1->title);
        $response->assertSee($link2->title);
    }


    /** @test **/
    function show_page_can_be_accessed_from_index_page()
    {
        //$response = $this->get(route('links.index'));
        //->clickLink('Title')
        //->seePageIs(route('links.show'));
        /*
        $this->browse(function ($browser) use ($this->user) {
            $browser->visit(route('links.index'))
                ->press('Comments')
                ->assertPathIs(route('links.show'));
        });
         */
    }


    /** @test **/
    function view_returns_404_when_link_not_found()
    {
        $response = $this->get('/links/' . 404);
        $response->assertStatus(404);
    }


    /** @test **/
    function show_page_returns_single_link()
    {
        $this->get('/links/' . $this->link->id)
            ->assertSee($this->link->title);
    }


    /** @test **/
    function auth_user_can_post_link()
    {
        $this->signIn();
        $this->post(route('links.store'), $this->link->toArray());
        $this->get('/links/' . $this->link->id)
            ->assertSee($this->link->title);
    }


    /** @test **/
    function non_authenticated_users_cannot_post_link()
    {
        $this->post('/links/store', $this->link->toArray())
            ->assertStatus(405);
    }


    /** @test **/
    function link_must_have_a_user()
    {
    }



    /** @test **/
    function a_link_can_be_deleted()
    {
        $this->signIn();
        $this->delete('/links/' . $this->link->id);
        $this->assertDatabaseMissing('links', ['id' => $this->link->id]);
    }


    /** @test **/
    function a_link_requires_a_title()
    {
        $this->publishLink(['title' => ''])
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
    function a_link_requires_a_url()
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

    function publishLink($data)
    {
        $this->signIn();
        $link = make('App\Link', $data);
        $response = $this->post(route('links.store'), $link->toArray());
        return $response;
    }

    // ASSERT THAT THE BASEURL() RETURNS URL AND NOT JUST A RONDOM STRING
    // SLUG MUST BE UNIQUE
    

    /** @test **/
    function a_link_has_a_reply()
    {
        $this->assertInstanceOf(
            Comment::class, 
            $link->comments->first()
        );
    }


    /** @test **/
    function a_link_has_replies()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', 
            $this->link->comments
        );
    }


    /** @test **/
    function a_user_can_see_links_comments()
    {
        create('App\Comment', [
                'commentable_id' => $this->link->id,
                'commentable_type' => 'App\Link',
        ]);
        $this->get('/links/' . $this->link->id)
            ->assertSee($comment->body);
    }
} 

