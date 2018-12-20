<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Upvote;

class UpvoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Link $link)
    {
        $link->upvote();
    }


    public function destroy($id)
    {
        //
    }
}
