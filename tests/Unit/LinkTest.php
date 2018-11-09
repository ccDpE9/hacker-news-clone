<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class LinkTest extends TestCase
{

    use DatabaseMigrations;


    protected $link;


    public function setUp()
    {
        parent::setUp();
        $this->link = create('App\Link');
    }


    /** @test **/
    public function a_link_has_a_comment()
    {
        create('App\Comment', [
            'commentable_id' => $this->link->id
        ]);
        $this->assertInstanceOf(
            'App\Comment',
            $this->link->comments->first()
        );
    }


    /** @test **/
    public function a_link_has_comments()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->link->comments
        );
    }


    /** @test **/
    public function a_link_has_a_creator()
    {
        $this->assertInstanceOf(
            'App\User',
            $this->link->user
        );
    }

}
