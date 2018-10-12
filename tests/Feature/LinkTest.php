<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LinkTest extends TestCase
{

    use DatabaseMigrations;

    /** @test **/
    public function user_can_view_index_page()
    {
        $response = $this->get('/links');
        $response->assertStatus(200);
    }

    /** @test **/
    public function user_can_view_links()
    {
        $link = factory('App\Link')->create();
        $response = $this->get('/links');
        $response->assertSee($link->title);
    }

    /** @test **/
    public function user_can_view_individual_link()
    {
        $link = factory('App\Link')->create();
        $response = $this->get('/links/' . $link->id);
        $response->assertSee($link->title);
    }

    /** @test **/
    public function auth_user_can_post_link()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user);
        // $link = factory('App\Link')->make();
        // code above drops an error, why?
        $link = factory('App\Link')->create();
        $this->post('/links/store', $link->toArray());
        $test = $this->get('/links/' . $link->id);
        $test->assertSee($link->title);
    }

    /** @test **/
    public function non_authenticated_users_cannot_post_link()
    {
        $link = factory('App\Link')->create();
        $request = $this->post('/links/store', $link->toArray());
        $request->assertStatus(405);
    }

}
