<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class LinkController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->only('store');
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
            'title' => 'bail|required|max:255',
            'url' => 'bail|required',
        ]);

        $link = Link::create([
            'title' => $request['title'],
            'url' => $request['url'],
            'description' => $request['description'],
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('links.show', $link->id);
    }

    // public function show(Link $link)
    public function show(Link $link)
    {
        $now = Carbon::now();
        $end = Carbon::parse($link->created_at);
        $diff = $end->diffForHumans($now);
        return view('links.show')
            ->with('link', $link)
            ->with('date', $diff);
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
        $link->delete();
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
