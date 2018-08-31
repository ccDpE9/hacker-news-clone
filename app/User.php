<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function links()
    {
        return $this->hasMany('App\Link');
    }

    public function likes()
    {
        return $this->hasMany('App\Upvote');
    }

}
