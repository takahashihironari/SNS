<?php

namespace App\Http\Controllers; //App\Http\Controllersフォルダにある
use App\Models\Post; //Postクラスを使う
use Illuminate\Http\Request; //Requestクラスを使用
use Illuminate\Support\Facades\Auth; //Authクラスを使用
use Illuminate\Support\Facades\DB; //DBクラスを使用
use Illuminate\Support\Facades\Validator; //Validatorクラスを使用
use Carbon\Carbon; //Carbonクラスを使用

class PostsController extends Controller //Controllerクラスを拡張するPostsControllerクラス
{
    protected function validator(array $data) //Validatorメソッド
    {
        return Validator::make($data, [ //validatorクラスを呼び出す
            'newContents' => ['required', 'space', 'string', 'max:100'], //投稿内容が空欄又はスペースのみで編集ボタン押下、投稿内容が入力文字数100字を超えた状態で編集ボタン押下されないようにする
        ]);//required=必須項目 string=文字列か max=文字数の上限 space=空白か
    }

    public function index(Request $request) //indexメソッド
    {
        $list = DB::table('posts')->get();
        return view('posts.index',['lists'=>$list]);

    }

}
