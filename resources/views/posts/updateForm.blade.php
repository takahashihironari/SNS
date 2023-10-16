@extends('layouts.app') <!--「app.blade.php」の方が親となり、「index.blade.php」の方が子のビューファイルとなる-->
@section('content') <!--囲っている部分の名前付け-->
<div class='container'> <!--containerクラス-->
  <h2 class='page-header'>投稿内容を変更する</h2> <!--タイトル-->
  {!! Form::open(['url' => '/post/update']) !!} <!--フォームの開始-->
  <div class="form-group">
  {!! Form::hidden('id', $contents->id) !!} <!--id-->
  {!! Form::input('text', 'upContents', $contents->contents, ['required', 'class' => 'form-control']) !!} <!--更新する内容-->
  @error('upContents') <!--upContentsに不適切な入力があった場合-->
    <div class="alert alert-danger">{{ $message }}</div> <!--エラー文を出す-->
  @enderror
  </div>
  <button type="submit" class="btn btn-primary pull-right">更新</button> <!--更新ボタン-->
  {!! Form::close() !!} <!--フォームを閉じる-->
</div>
@endsection
