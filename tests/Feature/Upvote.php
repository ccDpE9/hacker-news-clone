<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class Upvote extends TestCase
{

    use DatabaseMigrations;

    /** @test **/
    public function an_authnticated_users_can_upvote_a_link()
    {
        $this->signIn();
        $link = create('App\Link');
        $this->post('links/' . $link->slug . '/upvote');
        $this->assertCount(1, $link->upvotes);
    }

    /** @test **/
    public function unauthenticated_users_are_redirected_to_login_page()
    {
        $this->post('links/' . $link->slug . '/upvote')
            ->assertRedirect(route('login'));
    }


    /** @test **/
    public function authenticated_users_may_only_upvate_a_link_once()
    {
        $this->signIn();
        $link = create('App\Link');
        $this->post('links/' . $link->slug . '/upvote');
        $this->post('links/' . $link->slug . '/upvote');
        $this->assertCount(1, $link->upvotes)->assertDatabaseHas('upvotes', ['user_id' => auth()->id(), 'link_id' => $link->id]);
    }
}
