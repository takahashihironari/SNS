<?php

namespace App\Http\Controllers;


use App\Models\User;



class FollowController extends Controller
{

    // フォロー
    public function follow(User $user)
    {
        auth()->user()->following()->attach($user);
        return back();
    }


    // アンフォロー
    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user);
        return back();
    }


}
