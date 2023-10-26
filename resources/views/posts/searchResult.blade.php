@extends('layouts.app')

@section('content')

<div class="contain">
  @if (!empty($search))
    <h1>「{{$search}}」の検索結果</h1>
  @endif
  <form action="{{ route('user.search-result') }}" method="GET">
      <input type="text" name="keyword" placeholder="ユーザー名を入力してください">
      <button type="submit">検索</button>
  </form>

    <ul>
        @foreach ($users as $user)
            <li>
                <img src="{{ asset('storage/'.$user->avatar) }}" alt="Profile Image" class="avatar">
                <a href="{{ route('user.profile', ['id' => $user->id]) }}">{{ $user->name }}</a>
            </li>
        @endforeach

        @if (count($users) == 0)
            <p>検索結果は０件です。</p>
        @endif

    </ul>

</div>


@endsection






<style>



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

form {
    margin-bottom: 20px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

a {
    text-decoration: none;
    color: #000;
    font-weight: bold;
    margin-left: 10px;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}



.top {
    padding-left: 280px;

}




</style>
