<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Link;
use App\Upvote;

class UpvoteController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $link_id = $request['linkId'];

        $upvote = new Upvote;
        if (Auth::check()) {
            $upvote->user_id = Auth::user()->id;
        } else {
            $upvote->user_id = 4;
        }
        $upvote->link_id = $link_id;
        $upvote->upvote = 1;
        $upvote->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
