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
            'newContents' => ['required', 'space', 'string', 'max:150'], //投稿内容が空欄又はスペースのみで編集ボタン押下、投稿内容が入力文字数100字を超えた状態で編集ボタン押下されないようにする
        ]);//required=必須項目 string=文字列か max=文字数の上限 space=空白か
    }

    public function index(Request $request) //indexメソッド
    {
        $list = DB::table('posts')->get();
        $user  = Auth::user();
        return view('posts.index',['lists'=>$list,'user'=>$user]);

    }
    public function createForm() //createFormメソッド
    {
    return view('posts.createForm'); //postsディレクトリの中にあるcreateForm.blade.phpを呼び出す
    }

    public function create(Request $request) //$request変数に値が渡される
    {
    //バリデートの実施
    $validator = Validator::make($request->all(), [//validatorクラスを呼び出す
        'newContents' => 'required|space|max:150'//投稿内容が空欄又はスペースのみで編集ボタン押下、投稿内容が入力文字数100字を超えた状態で編集ボタン押下されないようにする
    ]);

    if ($validator->fails()) { //バリデーションが失敗したなら
        return redirect('/create-form') //create-formページへ遷移
        ->withErrors($validator) //validatorインスタンスの値を$errorsへ保存
        ->withInput(); //送信されたフォームの値をInput::old()へ引き継ぐ
    }

    $contents = $request->input('newContents'); //contents変数にrequest変数で取得したnewContentsの値を代入
    $name = $request->input('userName'); //name変数にrequest変数で取得したuserNameの値を代入
    DB::table('posts')->insert([ //postsテーブルにインサートする
    'contents' => $contents, //＄contentsをcontentsとして
    'user_name' => $name, //＄nameをuser_nameとして
    'created_at' => Carbon::now(), // 現在時刻をcreated_atとして
    'updated_at' => Carbon::now() // 現在時刻をupdated_atとして
    ]);
    return redirect('/index');//index.blade.phpに遷移
    }

    public function updateForm($id) //updateFormメソッド
    {
    $contents = DB::table('posts') //contents変数にpostsテーブルを代入
    ->where('id', $id)//更新したい投稿のIDを受け取り、その投稿の現在の内容を取得
    ->first();
    return view('posts.updateForm', ['contents' => $contents]); //現在の内容を表示
    }

    public function update(Request $request) //updateメソッド
    {
    $id = $request->input('id'); //id変数にname属性がidで指定されている値を取得して代入
    //バリデートの実施
    $validator = Validator::make($request->all(), [//validatorクラスを呼び出す
        'upContents' => 'required|space|max:150'//投稿内容が空欄又はスペースのみで編集ボタン押下、投稿内容が入力文字数100字を超えた状態で編集ボタン押下されないようにする
    ]);

    if ($validator->fails()) { //バリデーションが失敗したなら
        return redirect('/post/'.$id.'/update-form') //選択した投稿のupdate-formページへ遷移
        ->withErrors($validator) //validatorインスタンスの値を$errorsへ保存
        ->withInput(); //送信されたフォームの値をInput::old()へ引き継ぐ
    }

    $up_contents = $request->input('upContents'); //update_contents変数にname属性がupContentsで指定されている値を取得して代入
    DB::table('posts') //postsテーブルを呼び出す
    ->where('id', $id) //受け取ったidと一致した投稿を対象
    ->update( //postsテーブルのレコード更新
    ['contents' => $up_contents,
    'updated_at' => Carbon::now() // 現在時刻をupdated_atとして
    ] //$up_contentsをcontentsとして
    );
    return redirect('/index');//index.blade.phpに遷移
    }

    public function delete($id) //deleteメソッド
    {
    DB::table('posts') //postsテーブルを呼び出す
    ->where('id', $id) //受け取ったidと一致した投稿を対象
    ->delete(); //削除
    return redirect('/index');//index.blade.phpに遷移
    }

    public function __construct()
    {
    $this->middleware('auth'); //ログインできているか確認
    }

}
