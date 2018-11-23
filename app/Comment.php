<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'body', 
        'user_id', 
        'parent_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function commentable()
    {
        return $this->morphTo();
    }


    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }


    public function getCreatedAtAttribute()
    {
        $now = \Carbon\Carbon::now();
        $end = \Carbon\Carbon::parse(
            $this->attributes['created_at']
        );
        return $end->diffForHumans($now);
    }

}
