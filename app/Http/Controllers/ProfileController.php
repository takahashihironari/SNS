<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{

    // プロフィール画面表示
    public function profile($id)
    {

        $user  = User::find($id);
        $lists = Post::where('user_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('posts.profile', compact('user', 'lists'));

    }


     // プロフィール編集画面表示
    public function edit()
    {

        $user = auth() -> user();
        return view('posts.profile_edit', compact('user'));

    }


    // プロフィール更新
    public function update(Request $request)
    {
    $user = auth()->user();

      $request->validate([
        'name' =>'required|max:15|regex:/[^ 　]+$/',
        'introduction' => 'nullable|max:150',
        'avatar' => 'image',
    ]);

    $user->name = $request->input('name');
    $user->introduction = $request->input('introduction');

    if ($request->hasFile('avatar')) {

        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;

        }

    if (Hash::check($request->input('current_password'), $user->password)) {
        // パスワードが正しい場合の処理
        $user->save();
        Post::where('user_id', $user->id)
        ->update(['user_name' => $request->input('name')]);
        return redirect()->route('user.profile', ['id' => $user->id]);
    }
    else {
        // パスワードが正しくない場合の処理
        return redirect()->back()->with('error', 'パスワードが正しくありません');
    }}



    //フォロワー一覧
    public function followers($id)
    {

        $user      = User::find($id);
        $followers = $user->followers;

        return view('posts.followers', compact('user', 'followers'));

    }



    //フォロー一覧
    public function following($id)
    {

        $user = User::find($id);
        $following = $user->following;

        return view('posts.following', compact('user', 'following'));

    }


}
