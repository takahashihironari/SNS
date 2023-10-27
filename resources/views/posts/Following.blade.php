@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{ $user->name }}</h1>
        <h5>フォロー中</h5>

        <div class="follow-list">
            <ul>
                @foreach ($following as $followedUser)
                    <li class=following_box>
                        <a href="{{ route('user.profile', ['id' => $followedUser->id]) }}">
                        <img src="{{ asset('storage/'.$followedUser->avatar) }}" alt="Profile Image" class="user-icon">
                        {{ $followedUser->name }}
                        </a>
                @if (auth()->user()->id !== $followedUser->id)
                  @if (auth()->user()->isFollowing($followedUser))
                <form method="POST" action="{{ route('unfollow', ['user' => $followedUser->id]) }}">
                    @csrf
                    <button type="submit">アンフォロー</button>
                </form>
                  @else
                <form method="POST" action="{{ route('follow', ['user' => $followedUser->id]) }}">
                  @csrf
                    <button type="submit">フォロー</button>
                </form>
                @endif
                  @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection



<style>


ul {
    list-style: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
}


.following_box{
    border: 1px solid #ddd;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
}


li:hover {
    background-color: #e0e0e0;
}

.follow-list ul li a {
    color: black;
    text-decoration: none;
}


.user-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}


</style>
