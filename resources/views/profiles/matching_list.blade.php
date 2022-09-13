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
        <h1>マッチングリスト</h1>
        <div class='profiles'>
            @foreach ($matched_users_relations as $matched_users_relation)
                    <div class='profile'>
                    <a href='/profile/{{ $matched_users_relation->user->id }}'>
                        <p class='user_name'>ユーザー名　　　{{ $matched_users_relation->user->user_name }}</p>
                    </a>
                    <p class='age'>年齢　　　　　　{{ $matched_users_relation->user->age }}歳</p>
                    <p class='facility'>利用可能施設　　{{ $matched_users_relation->user->facility }}</p>
                    <p class='years_of_experience'>テニス歴　　　　{{ $matched_users_relation->user->years_of_experience}}年</p>
                    <p class='career'>実績　　　　　　{{ $matched_users_relation->user->career }}</p>
                    <br>
                </div>
            @endforeach
        </div>
    </body>
</html>
@endsection