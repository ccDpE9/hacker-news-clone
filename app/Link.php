<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    protected $fillable = [
        'title', 
        'slug', 
        'url', 
        'description', 
        'user_id'
    ];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($link) {
            $link->comments()->delete();
        });

        static::created(function ($link) {
            $link->update(['slug' => $link->title]);
        });

        static::addGlobalScope('commentsCount', function ($builder) {
            // global scope is query scope that is automatically applied to all queries
            $builder->withCount('comments');
        });
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function upvotes()
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


    public function getRouteKeyName()
    {
        return 'slug';
    }


    /*
    public function getCreatedAtAttribute()
    {
        $now = \Carbon\Carbon::now();
        $end = \Carbon\Carbon::parse(
            $this->attributes['created_at']
        );
        return $end->diffForHumans($now);
    }
     */


    public function setSlugAttribute($value)
    {
        // check if the record with the given slug exists
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes['slug'] = $slug;
    }

}
