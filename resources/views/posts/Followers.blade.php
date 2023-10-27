@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{ $user->name }}</h1>
        <h5>フォロワー</h5>

        <div class="follow-list">
            <ul>
              @foreach ($followers as $follower)
                <li class="followers_box">
                    <a href="{{ route('user.profile', ['id' => $follower->id]) }}" class="user-name">
                        <img src="{{ asset('storage/'.$follower->avatar) }}" alt="Profile Image" class="user-icon">
                        {{ $follower->name }}
                    </a>

                    @if (auth()->user()->id !== $follower->id)
                        @if (auth()->user()->isFollowing($follower))
                            <form method="POST" action="{{ route('unfollow', ['user' => $follower->id]) }}">
                            @csrf
                                <button type="submit">アンフォロー</button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('follow', ['user' => $follower->id]) }}">
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


.followers_box {
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
