<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{

    use DatabaseMigrations;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = create('App\User');
    }


    /** @test **/
    public function user_has_a_single_link_and_a_single_comment()
    {
        create('App\Link', [
            'user_id' => $this->user->id
        ]);
        create('App\Comment', [
            'user_id' => $this->user->id
        ]);
        $this->assertInstanceOf(
            'App\Link',
            $this->user->links->first()
        );
        $this->assertInstanceOf(
            'App\Comment',
            $this->user->comments->first()
        );
    }

    /** @test **/
    public function user_has_multiple_links_and_comments()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->user->links
        );
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->user->comments
        );
    }

    // links returns latest
    // comments returns latest
}
