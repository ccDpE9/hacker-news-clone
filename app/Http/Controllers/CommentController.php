<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Link;
use App\Http\Requests\CommentFormRequest;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(CommentFormRequest $request)
    {

        $link = Link::find($request['link_id']);

        $link->comments()->create([
            'body' => $request['body'],
            'user_id' => auth()->id(),
            'parent_id' => (null !== ($request->has('comment_id'))
                ? $request['comment_id']
                : null
            )
        ]);
        
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
