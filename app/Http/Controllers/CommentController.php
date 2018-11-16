<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Link;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Request $request)
    {
        $request->validate([
            'body' => 'bail|required',
            'link_id' => 'required|integer'
        ]);

        $comment = new Comment;
        $comment->body = $request['body'];
        $comment->user()->associate($request->user());

        if ($request->has('comment_id')) {
            $request->validate([
                'comment_id' => 'integer'
            ]);
            $comment->parent_id = $request['comment_id'];
        }

        $link = Link::find($request['link_id']);
        $link->comments()->save($comment);
        
        return redirect()->route('links.show', $link);
    }


    public function edit(Link $link)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->delete();
        return redirect()->back();
    }
}
