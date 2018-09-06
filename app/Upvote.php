<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
