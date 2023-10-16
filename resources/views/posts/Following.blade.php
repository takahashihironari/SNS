@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{ $user->name }}</h1>
        <h5>フォロー</h5>

        <div class="follow-list">
            <ul>
                @foreach ($following as $followedUser)
                    <li>
                    <a href="{{ route('user.profile', ['id' => $followedUser->id]) }}">
                    <img src="{{ asset('storage/'.$followedUser->avatar) }}" alt="Profile Image" class="user-icon">
                    {{ $followedUser->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

@endsection

@push('styles')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endpush





<style>


.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
}


li {
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
