<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, User $user)
    {
        auth()->user()->follow($user);

        return redirect()->back();
    }
    public function destroy(User $user)
    {
        auth()->user()->unfollow($user);

        return back();
    }
}
