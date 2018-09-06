<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $linkId = $request['linkId'];
        $upvote = Upvote::where('link_id', $linkId)
            ->first();
        if (!$upvote) {
            $upvote = new Upvote;
            if (Auth::check()) {
                $upvote->user_id = Auth::user()->id;
            }
            $upvote->link_id = $linkId;
            $upvote->upvote = 1;
            $upvote->save();
        } else if ($upvote->upvote == 1) {
            $upvote->upvote = 0;
            $upvote->save();
        } else {
            $upvote->upvote = 1;
            $upvote->save();
        }

        /*
        $linkId = $request['linkId'];
        try {
            $upvote = Upvote::where('link_id', linkId)
                ->where('user_id', Auth::user()->id)
                ->firstOrFail();
            if ($upvote->link_id == 1) {
                $upvote->link_id = 0;
                $upvote->save();
            } else {
                $upvote->link_id = 1;
                $upvote->save();
            }
        } catch (ErrorException $e) {
            $upvote = new Upvote;
            if (Auth::check()) {
                $upvote->user_id == Auth::user()->id;
            }
            $upvote->link_id = $link_id;
            $upvote->upvote = 1;
            $upvote->save();
        }
         */

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
