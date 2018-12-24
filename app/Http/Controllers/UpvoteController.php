<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Upvote;
use App\Link;

class UpvoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($slug)
    {
        $link = Link::where('slug', $slug)->firstOrFail();
        Upvote::create([
            'link_id' => $link->id,
            'user_id' => auth()->id()
        ]);

        return redirect(route('links.index'));
    }


    public function destroy($id)
    {
        //
    }
}
