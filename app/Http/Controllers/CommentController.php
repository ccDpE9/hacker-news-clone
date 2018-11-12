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
        $link = Link::find($request['link_id']);
        $link->comments()->save($comment);
        
        return redirect()->route('links.show', $link);
    }

    public function replyStore(Request $request)
    {
        $request->validate([
            'body' => 'bail|required',
            'comment_id' => 'required|integer',
            'link_id' => 'required|integer'
        ]);

        $reply = new Comment;
        $reply->body = $request['body'];
        $reply->user()->associate($request->user());
        $reply->parent_id = $request['comment_id'];
        $link = Link::find($request['link_id']);
        $link->comments()->save($reply);

        return redirect()->route('links.show', $request['link_id']);
    }

    public function edit($id)
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
