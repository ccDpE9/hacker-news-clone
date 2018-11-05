<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\User;

abstract class TestCase extends BaseTestCase
{

    use CreatesApplication;


    protected function signIn($user = null)
    {
        $user = $user ?: create(User::class);
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
