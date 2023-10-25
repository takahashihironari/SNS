@extends('layouts.app')

@section('content')
<div class="container">
    <h4>プロフィール編集</h4>

      <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

             <div class="form-group">
                <label for="introduction">自己紹介</label>
                <textarea class="form-control" name="introduction">{{ $user->introduction }}</textarea>
             </div>

             <div class="form-group">
                <label for="avatar">アイコン画像</label>
                <div class="profile-image">
                  <img src="{{ asset('storage/'.$user->avatar) }}" alt="Profile Image">
                </div>
                <input type="file" name="avatar" class="form-control-file mt-2">
            </div>

            <div class="form-group">
                 <label for="current_password">パスワード</label>
                 <input type="text" name="current_password" class="form-control">
            </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary">更新</button>
    </form>

</div>

@endsection



<style>
  /* ページ全体のスタイル */
.container {
    max-width: 600px;
    margin: 0 auto;
}

/* ページタイトルのスタイル */
h4 {
    font-size: 24px;
    margin: 20px 0;
}

/* フォームのスタイル */
.form-group {
    margin-bottom: 20px;
}

/* ラベルのスタイル */
label {
    font-weight: bold;
}

/* アイコン画像のスタイル */

.profile-image {
    text-align:left;
    margin-top: 20px;
}

.profile-image img {
    max-width: 80px;
    border: 1px solid #ccc;
    border-radius: 50%; /* 50%に設定して丸くします */
}

/* 更新ボタンのスタイル */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}

</style>
