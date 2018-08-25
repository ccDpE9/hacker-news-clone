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

    public function create()
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
        $links = Link::where('user_id', $profile->id)->get();
        return view('profiles.show')->with('profile', $profile)->with('links', $links);
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
}
