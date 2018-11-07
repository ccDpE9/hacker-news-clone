<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Comment;

class LinkController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->only('create');
    }


    public function index()
    {
        $links = Link::with('user')
            ->get();
        return view('links.index')
            ->with('links', $links);
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|max:55',
            'url' => 'bail|required|url',
        ]);


        $link = Link::create([
            'title' => $request['title'],
            'url' => $request['url'],
            'description' => $request['description'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('links.show', [$link]);
    }

    // public function show(Link $link)
    public function show(Link $link)
    {
        // comment
        // 1. load comments
        // where 'commentable_id' == $link->id AND parent_id == Null
        // what the difference between: ::where() vs ::where()->get()
        // there is a difference between $comment->replies and $comment->replies()
        // dd(gettype($comments[0]->replies));
        $comments = Comment::where('commentable_id', $link->id)->where('parent_id', Null)->get();
        // $end = Carbon::parse($comments->created_at);

        // returned compacted
        // if i chain 4 withs, it'll look ugly
        return view('links.show')
            ->with('link', $link)
            ->with('comments', $comments);
    }

    public function edit(Link $link)
    {
        //
    }

    public function update(Request $request, Link $link)
    {
        //
    }

    public function destroy(Link $link)
    {
        //
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);
        // is just a string equal to input value
        $query = $request->input('query');
        $links = Link::where('title', $query)->get();
        return view('links.index')->with('links', $links);
    }

}
