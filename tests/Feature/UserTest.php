<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{

    use DatabaseMigrations;


    /** @test **/
    public function user_can_view_a_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }


    /** @test **/
    public function a_user_has_many_links()
    {
        $user = create('App\User');
        create('App\Link', [ 
            'title' => 'Test',
            'url' => 'www.test.com',
            'user_id' => $user->id
        ]);
        $this->assertInstanceOf('App\Link', $user->links->first());
    }

}
