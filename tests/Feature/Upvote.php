<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class Upvote extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->link = create('App\Link');
    }

    /** @test **/
    public function authenticated_users_can_upvote_a_link()
    {
        $this->signIn();
        $this->get(route('upvotes.store', $this->link->slug));
        //$this->assertCount(1, $this->link->upvotes);
        $this->assertDatabaseHas('upvotes', [
            'user_id' => auth()->id(),
            'link_id' => $this->link->id
        ]);
    }

    /** @test **/
    public function unauthenticated_users_are_redirected_to_login_page()
    {
        $this->get(route('upvotes.store', $this->link->slug))->assertRedirect(route('login'));
    }

    /** @test **/
    public function authenticated_users_may_only_upvote_a_link_once()
    {
        $this->signIn();
        $this->get(route('upvotes.store', $this->link->slug));
        // db unique constrait
        $this->get(route('upvotes.store', $this->link->slug))->assertStatus(500);
    }
}
