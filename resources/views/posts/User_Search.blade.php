@extends('layouts.app')

@section('content')

<div class="contain">
    <h1>ユーザー検索</h1>

    <form action="{{ route('user.search-result') }}" method="GET">
        <input type="text" name="keyword" placeholder="ユーザー名を入力してください">
        <button type="submit">検索</button>
    </form>

    <ul>
    @foreach ($users as $user)
        <li>
            <div class=serch_list>
                <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                <img src="{{ asset('storage/'.$user->avatar) }}" alt="Profile Image" class="avatar"></a>
                <a href="{{ route('user.profile', ['id' => $user->id]) }}">{{ $user->name }}</a>
            </div>
            @if(auth()->user()->id !== $user->id)
                @if (auth()->user()->isFollowing($user))
                    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">フォロー中</button>
                    </form>
                @else
                    <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success le">フォローする</button>
                    </form>
                @endif
            @endif
        </li>
    @endforeach
</ul>


</div>
@endsection





<style>

.serch_list{
flex: 1;
display:flex;
align-items: center;
}


body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}


.contain {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}



li {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}



.serch_list a {
    color: #000; /* ユーザー名のテキストを黒色に設定 */
    text-decoration: none; /* 下線を削除 */
    font-weight: bold;
    margin-left: 10px;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}





</style>
