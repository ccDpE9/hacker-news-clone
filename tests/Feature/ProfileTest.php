<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        $this->user = create("App\User");
    }

    /** @test **/
    public function a_user_has_a_profile()
    {
        $this->get("/profiles/{ $this->user->name }")->assertSee($this->user->name);

    }

    // JUST COPY THE REDDITS USER PROFILE PAGE LAYOUT // 

    /** @test **/
    public function a_user_profile_page_displays_all_links_submitted_by_the_user()
    {
        $this->get("/profiles/{ $this->user->name }")->assertSee("Submitted");
    }


    /** @test **/
    public function a_user_profile_page_contains_about_section()
    {
        $this->get("profiles/{ $this->user->name }")
            ->assertSee($this->user->about);
    }

    /** @test **/
    public function a_user_profile_page_contains_all_comments_submitted_by_the_user()
    {
        $this->get("/profiles/{ $this->user->name }")
            ->assertSee("Comments");
    }

    /** @test **/
    public function a_user_profile_page_contains_all_links_upvotes_by_the_user()
    {
    }

    /** @test **/
    public function a_user_profile_page_contains_all_comments_upvotes_by_the_user()
    {
    }


}
