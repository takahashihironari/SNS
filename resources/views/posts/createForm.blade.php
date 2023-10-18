@extends('layouts.app') <!--「app.blade.php」の方が親となり、「index.blade.php」の方が子のビューファイルとなる-->
@section('content') <!--囲っている部分の名前付け-->
<div class='container'> <!--containerクラス-->
  <h2 class='page-header'>新しく投稿する</h2> <!--小見出し-->
  {!! Form::open(['url' => 'post/create']) !!} <!--urlが 'post/create' となっているところにフォームの値を送る-->
  <div class="form-group">
  {{ Form::label('user_name', '名前：') }} <!-- デフォルトでユーザー登録した名前を入力しておく -->
  <!-- {{ Form::input('text', 'userName',  Auth::user()->name) }} -->
  {{ Form::label('iUserName',  Auth::user()->name) }}
  {!! Form::hidden('userName', Auth::user()->name) !!} <!--id-->
     <input type="hidden" name="id" value="{{$user->id}}">
  </div>
  <div class="form-group">
  {!! Form::input('text', 'newContents', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!} <!--投稿内容-->
  @error('newContents') <!--newContentsに不適切な入力があった場合-->
    <div class="alert alert-danger">{{ $message }}</div> <!--エラー文を出す-->
  @enderror
  </div>
  <button type="submit" class="btn btn-success pull-right">追加</button> <!--追加ボタン-->
  {!! Form::close() !!} <!--フォームを閉じる-->
</div>
@endsection
