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


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($link) {
            $user->links()->delete();
        });

    }


    public function links()
    {
        return $this->hasMany('App\Link')->latest();
    }


    public function comments()
    {
        return $this->hasMany('App\Comment')->latest();
    }


    public function upvotes()
    {
        return $this->hasMany('App\Upvote');
    }


    public function getLastLoginAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d.m.Y');
    }

}
