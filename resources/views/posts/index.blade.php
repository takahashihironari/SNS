@extends('layouts.app')
@section('content')


<div class="card-body text-center">
    <div class="profile-image">
    <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="name">
     <img src="{{ asset('storage/'.$user->avatar) }}"alt="Profile Image" class="avatar">
    </a>
    </div>

    <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="name">
       <h4 class="mt-3">{{ $user->name }}</h4>
    </a>
</div>

<div class='container'> <!--containerクラス-->
  <p class="pull-right"><a class="btn btn-success" href="/create-form">投稿する</a></p> <!--投稿するボタン-->
  <h2 class='page-header'>投稿一覧</h2> <!--タイトル-->
  <div id="search"> <!--検索ボタン-->
      <form action="/index" method="get"> <!--indexページにget通信で送る-->
          <input type="submit" name="submit" value="検索"> <!--ボタン-->
      </form>
  </div>
  <table class='table table-hover'> <!--表-->
    <tr> <!--表の1行-->
      <th>名前</th> <!--表の見出し-->
      <th>投稿内容</th> <!--表の見出し-->
      <th>投稿日時</th> <!--表の見出し-->
      <th></th> <!--表の見出し-->
      <th></th> <!--表の見出し-->
    </tr>
    @foreach ($lists as $list)
    <tr> <!--containerクラス-->
      <td>{{ $list->user_name }}</td> <!--$listの中のusernameを表示-->
      <td>{{ $list->contents }}</td> <!--$listの中のcontentsを表示-->
      <td>{{ $list->created_at }}</td> <!--$listの中のcreated_atを表示-->
      @if ($list->user_name == Auth::user()->name) <!-- ログインユーザーが投稿したもののみボタン表示 -->
      <td><a class="btn btn-primary" href="/post/{{ $list->id }}/update-form">更新</a></td> <!--更新ボタン-->
      <td><a class="btn btn-danger" href="/post/{{ $list->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td> <!--削除ボタン-->
      @endif
    </tr>
    @endforeach
  </table>
</div>
@endsection


<style>

.profile-image {
    text-align:center;
    margin-top: 20px;
}

.profile-image img {
    max-width: 80px;
    border: 1px solid #ccc;
    border-radius: 50%; /* 50%に設定して丸くします */
}
</style>
