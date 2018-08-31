<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function links()
    {
        return $this->belongsTo('App\Link');
    }

}
