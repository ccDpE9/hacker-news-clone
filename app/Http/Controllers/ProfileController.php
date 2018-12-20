<?php

namespace App\Http\Controllers;

use App\User;
use App\Link;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show(User $user)
    {
        return view('profiles.show')->with('profile', $user);
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

    public function links(User $user)
    {
        $links = Link::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('links.index')
            ->with('profile', $user)
            ->with('links', $links);
    }
}
