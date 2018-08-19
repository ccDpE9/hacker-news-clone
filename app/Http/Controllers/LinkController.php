<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::orderBy('id', 'desc')->paginate(30);
        return view('links.index')->with('links', $links);
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|max:255',
            'url' => 'bail|required',
        ]);

        $link = new Link;
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;
        $link->save();

        return redirect()->route('link.show', $link->id);
    }

    // public function show(Link $link)
    public function show($id)
    {
        $link = Link::where('id', $id)->firstOrFail();
        return view('links.show')->with('link', $link);
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
}
