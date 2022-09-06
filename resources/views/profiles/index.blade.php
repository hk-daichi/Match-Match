@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Match×Match</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1>プロフィール一覧</h1>
        <div class='profiles'>
            @foreach ($users as $user)
                <div class='profile'>
                    <p class='user_name'>ユーザー名　　　{{ $user->user_name }}</p>
                    <p class='age'>年齢　　　　　　{{ $user->age }}歳</p>
                    <p class='facility'>利用可能施設　　{{ $user->facility }}</p>
                    <p class='years_of_experience'>テニス歴　　　　{{ $user->years_of_experience}}年</p>
                    <p class='career'>実績　　　　　　{{ $user->career }}</p>
                    <br>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $users->links() }}
        </div>
    </body>
</html>
@endsection