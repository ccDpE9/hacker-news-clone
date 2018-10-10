<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LinkTest extends TestCase
{

    use RefreshDatabase;

    /** @test **/
    public function user_can_view_index_page()
    {
        $response = $this->get('/links');
        $response->assertStatus(200);
    }
}
