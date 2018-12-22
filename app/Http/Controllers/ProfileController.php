<?php

namespace App\Http\Controllers;

use App\User;
use App\Link;

use Illuminate\Http\Request;

use Carbon\Carbon;

class ProfileController extends Controller
{

    public function show($name)
    {
        // $overview = User::where('name', $name)->with(['links', 'upvotes'])->first();
        $user = User::where('name', $name)->first();
        $overview = $user->links->merge($user->comments)->sortBy('created_at');
        return view('profiles.show', [
            'name' => $user->name,
            'about' => $user->about,
            'memberSince' => $user->created_at,
            'overview' => $overview
        ]);
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
        $user = User::where('name', $name)->firstOrFail();
        return view('profiles.links', [
            'name' => $user->name,
            'about' => $user->about,
            'memberSince' => $user->created_at,
            'links' => $user->links
        ]);
    }

    public function comments(User $user)
    {
        $user = User::where('name', $name)->firstOrFail();
        return view('profiles.comments', [
            'name' => $user->name,
            'about' => $user->about,
            'memberSince' => $user->created_at,
            'comments' => $user->comments,
        ]);
    }

    public function upvotes(User $user)
    {
        $user = User::where('name', $name)->firstOrFail();
        return view('profiles.upvotes', [
            'name' => $user->name,
            'about' => $user->about,
            'memberSince' => $user->created_at,
            'upvotes' => $user->upvotes
        ]);
    }
}
