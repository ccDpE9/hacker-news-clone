<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateLinkTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->link = [
            "title" => "Just a valid title",
            "url" => "http://example.com/",
            "description" => "Just some body text"
        ];
    }

    /** @test */
    public function user_can_create_links() {
        $this
            ->post(route("links.store"), $this->link)
            ->assertStatus(201)
            ->assertJson([
                "data" => $this->link
            ]);
        $this->assertDatabaseHas("links", $this->link);
    }

    // --- title field validation tests

    /** @test */
    public function title_field_is_required()
    {
        unset($this->link["title"]);

        $this
            ->post(route("links.store"),$this->link)
            ->assertSessionHasErrors();
    }

    // --- url field validation tests

    /** @test */
    public function url_field_is_required()
    {
        unset($this->link["url"]);

        $this
            ->post(route("links.store"), $this->link)
            ->assertSessionHasErrors();
    }

    /** @test */
    public function invalid_url_returns_an_error()
    {
        $this->link["url"] = "invalid/.com";

        $this
            ->post(route("links.store"), $this->link)
            ->assertSessionHasErrors();
    }


    // --- slug field validation tests

    /** @test */
    public function providing_slug_field_is_not_required()
    {

        $this->withoutExceptionHandling();

        if (in_array("slug", $this->link)) {
            unset($this->link["slug"]);
        }

        $this->post(route("links.store"), $this->link);
        $this->assertDatabaseHas("links", $this->link);
    }

    // --- description field validation tests

    /** @test */
    public function description_field_is_required()
    {
        unset($this->link["description"]);

        $this
            ->post(route("links.store"), $this->link)
            ->assertSessionHasErrors();
    }
}
