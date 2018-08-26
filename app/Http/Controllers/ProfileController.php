<?php

namespace App\Http\Controllers;

use App\User;
use App\Link;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    // public function show(User $user)
    public function show($name)
    {
        $profile = User::where('name', $name)->firstOrFail();
        return view('profiles.show')->with('profile', $profile);
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

    public function links($name)
    {
        $profile = User::where('name', $name)->firstOrFail();
        $links = Link::where('user_id', $profile->id)->orderBy('created_at', 'desc')->get();
        return view('links.index')->with('profile', $profile)->with('links', $links);
    }
}
