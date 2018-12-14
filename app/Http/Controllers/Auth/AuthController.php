<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Socialite;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        // use Socialite facade through 'Socialite' alias
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return Redirect::to('auth/'+$provider);
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        return Redirect::to('home');
    }

    private function findOrCreateUser($user, $provider)
    {
        if ($authUser = User::where('provider_id', $user->id)->first()) {
            return $user;
        }

        return User::create([
            'email' => $user->email,
            'provider_name' => $provider,
            'provider_id' => $user->id,
        ]);
    }

}
