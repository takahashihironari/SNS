@extends('layouts.app')

@section('content')
<div class="container">
  <div class="user-profile">
    <div class="profile-image">
        <img src="{{ asset('storage/'.$user->avatar) }}" alt="Profile Image">
    </div>


    <div class="user-details">
        <h4>{{ $user->name }}</h4>

        <!-- ログインユーザーの場合プロフィール編集ボタンを表示-->
        @if (auth()->user()->id === $user->id)
        <a href="{{ route('user.edit') }}" class="btn btn-primary">プロフィール編集</a>
        @endif

        <h5>自己紹介: {{ $user->introduction }}</h5>

<ul class="navbar-nav ml-auto">
 <li class="nav-item">
        <a href="{{ route('following', ['id' => $user->id]) }}" class="no-underline">フォロー数:{{ $user->following->count() }}</a>

    </li>
    <li class="nav-item">
        <a href="{{ route('followers', ['id' => $user->id]) }}" class="no-underline">フォロワー数:{{ $user->followers->count() }}</a>
    </li>

            <!-- 表示しているユーザーがログインユーザーではない場合かつ、フォローしているユーザーの場合 -->
            @if(auth()->user()->id !== $user->id)
                @if (auth()->user()->isFollowing($user))
                    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                 @csrf
                        <button type="submit" class="btn btn-danger">フォロー中</button>
                    </form>

            <!-- 表示しているユーザーがログインユーザーではない場合かつ、フォローしていないユーザーの場合 -->
                @else
                    <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                 @csrf
                        <button type="submit" class="btn btn-success">フォロー</button>
                    </form>
                @endif
            @endif

</ul>
</div>
</div>

<div class="user-posts">
<h5>投稿一覧</h5>
<ul>
    @forelse ($lists as $list)
        <li class="post-item">
            <div class="post-header">
                <div class="user-info">
                    <img src="{{ asset('storage/'.$list->user->avatar) }}" alt="Profile Image" class="avatar">
                    <h6>{{ $list->user_name }}</h6>
                </div>
                <div class="post-meta">
                    <span>{{ $list->created_at->format('Y/m/d') }}</span>
                </div>
            </div>
            <p>{{ $list->contents }}</p>
        </li>

    @empty   <!-- 空の場合 -->
        <li>投稿はありません。</li>
    @endforelse

</ul>

@endsection






<style>
/* ユーザープロフィールのスタイル */

.user-profile {
    display: flex;
    justify-content: space-between;
}

.profile-image {
    margin-top: 20px;
}

.profile-image img {
    max-width: 80px;
    border: 1px solid #ccc;
    border-radius: 50%; /* 50%に設定して丸くします */
}

.user-details {
    flex: 1;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    border-radius: 4px;
}

.user-details h4 {
    font-size: 24px;
    margin: 0;
}

.user-details h5 {
    font-size: 16px;
}

/* フォローボタンのスタイル */
.user-details .btn {
    margin-top: 10px;
}

/* 投稿一覧のスタイル */
.user-posts h5 {
    font-size: 20px;
    padding-top: 50px;
}

.post-item {
    margin: 20px 0;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    border-radius: 4px;
}

.post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.user-info {
    display: flex;
    align-items: center;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.user-info h6 {
    font-size: 16px;
    margin: 0;
}

.post-meta {
    font-size: 14px;
    color: #777;
}

.post-item p {
    font-size: 16px;
}

/* タイトルがない場合のメッセージ */
.user-posts li {
    font-size: 16px;
    color: #777;
}

</style>
