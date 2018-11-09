<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        'App\Link' => 'App\Policies\LinkPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
