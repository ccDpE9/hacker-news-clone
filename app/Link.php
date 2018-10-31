<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Link extends Model
{


    protected $fillable = ['title', 'url', 'description', 'user_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Upvote');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function date()
    {
        $now = Carbon::now();
        $end = Carbon::parse($this->created_at);
        $diff = $end->diffForHumans($now);
        return $diff;
    }


    public function baseUrl()
    {
        return str_ireplace('www.', '', parse_url($this->url, PHP_URL_HOST));
    }

}
