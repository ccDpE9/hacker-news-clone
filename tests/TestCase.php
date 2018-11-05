<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    use CreatesApplication;


    protected function signIn()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user);
        return $this;
    }


    function create($class, $attributes = []) {
        return factory($class)->create($attributes);
    }

    function make($class, $attributes = []) {
        return factory($class)->make($attributes);
    }

}
