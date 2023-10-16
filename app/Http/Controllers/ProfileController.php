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
        $lists = Post::where('user_id', $id)->get();

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
        'name' => 'required|string|max:255',
        'introduction' => 'nullable|string',
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
        return redirect()->route('user.profile', ['id' => $user->id]);
    }
    else {
        // パスワードが正しくない場合の処理
        return redirect()->back()->with('error', 'パスワードが正しくありません');
    }

}














}
