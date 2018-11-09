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
        return $link->user_id == $user->id;
    }

}
