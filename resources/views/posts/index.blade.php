@extends('layouts.app')
@section('content')


<div class="card-body text-center">
    <div class="profile-image">
    <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="name">
     <img src="{{ asset('storage/'.$user->avatar) }}"alt="Profile Image" class="user-icon">
    </a>
    </div>

    <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="name">
       <h4 class="mt-3">{{ $user->name }}</h4>
    </a>
</div>

<div class='container'> <!--containerクラス-->
  <p class="pull-right"><a class="btn btn-success" href="/create-form">投稿する</a></p> <!--投稿するボタン-->
  <p class="pull-right"><a class="btn btn-success" href="/user-search">検索</a></p> <!--検索ボタン-->
  <h2 class='page-header'>投稿一覧</h2> <!--タイトル-->
  <table class='table table-hover'> <!--表-->
    <tr> <!--表の1行-->
      <th>名前</th> <!--表の見出し-->
      <th>投稿内容</th> <!--表の見出し-->
      <th>投稿日時</th> <!--表の見出し-->
      <th>更新日時</th> <!--表の見出し-->
      <th></th> <!--表の見出し-->
      <th></th> <!--表の見出し-->
    </tr>

    @foreach ($lists as $list)
            @if ($list->user_name == Auth::user()->name || in_array($list->user->id, Auth::user()->following->pluck('id')->toArray()))
                <tr>
                    <td>
                       <img src="{{ asset('storage/'.$list->user->avatar) }}" alt="User Avatar" class="user-icon">
                        <a href="{{ route('user.profile', ['id' => $list->user->id]) }}" class="name">
                            {{ $list->user_name }}
                        </a>
                    </td>
                    <td>{{ $list->contents }}</td>
                    <td>{{ $list->created_at }}</td>
                    <td>{{ $list->updated_at }}</td>
                     <td>
                        @if ($list->user_name == Auth::user()->name)
                          <a class="btn btn-primary" href="/post/{{ $list->id }}/update-form">更新</a>
                         @endif
                     </td>
                     <td>
                         @if ($list->user_name == Auth::user()->name)
                           <a class="btn btn-danger" href="/post/{{ $list->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
                         @endif
                     </td>
                </tr>
            @endif
        @endforeach
  </table>
</div>
@endsection


<style>


.user-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}
</style>
