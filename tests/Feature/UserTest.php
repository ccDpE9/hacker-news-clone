<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{

    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();
        $this->user = create('App\User');
    }


    /** @test **/
    public function user_has_a_link()
    {
        create('App\Link', [
            'user_id' => $this->user->id
        ]);
        $this->assertInstanceOf(
            \App\Link::class,
            $this->user->links->first()
        );
    }


    /** @test **/
    public function user_has_many_links()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', 
            $this->user->links
        );
    }


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


    /** @test **/
    public function the_name_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => null])
        )->assertSessionHasErrors('name');
    }


    /** @test **/
    public function the_name_must_be_unique()
    {
        create('App\User', [
            'name' => 'Knever'
        ]);
        $this->post(
            route('register'),
            $this->userValidData()
        )->assertSessionHasErrors('name');
    }


    /** @test **/
    public function the_email_must_be_unique()
    {
        create('App\User', [
            'email' => 'example@gmail.com'
        ]);
        $this->post(
            route('register'),
            $this->userValidData()
        )->assertSessionHasErrors('email');
    }


    /** @test **/
    public function the_name_may_not_be_greater_than_60_chars_long()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => str_random(61)])
        )->assertSessionHasErrors('name');
    }
    

    public function userValidData($overrides = [])
    {
        return array_merge([
            'name' => 'Knever',
            'first_name' => 'Sibylle',
            'last_name' => 'Baier',
            'email' => 'example@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ], $overrides);
    }

}
