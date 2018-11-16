<?php

namespace App\Policies;

use App\User;
use App\Link;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Link $link)
    {
        return $user->id === (int) $link->user_id;
    }

}
