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
        <h1>マッチングリクエスト</h1>
        <div class='profiles'>
            @foreach ($recieved_users_relations as $recieved_users_relation)
                <div class='profile'>
                    <a href='/profile/{{ $recieved_users_relation->id }}'>
                        <p class='user_name'>ユーザー名　　　{{ $recieved_users_relation->user_name }}</p>
                    </a>
                </div>
                <div class='matching_request'>
                    <form action="/matching_list" method="POST",  style="display:inline">
                        @csrf
                        <input type="hidden" name="to_user_id" value="{{ $recieved_users_relation->id }}">
                        <input type="hidden" name="matching_request" value="1">
                        <button type="submit">
                            承認する
                        </button>
                    </form>
                    <form action="/matching_list" method="POST",  style="display:inline">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="from_user_id" value="{{ $recieved_users_relation->id }}">
                        <input type="hidden" name="to_user_id" value="{{ Auth::user()->id }}">
                        <button type="submit">
                            拒否する
                        </button>
                    </form>
                    <br>
                </div>
            @endforeach
        </div>
        <h1>マッチングリスト</h1>
        <div class='profiles'>
            @foreach ($matched_users_relations as $matched_users_relation)
                    <div class='profile'>
                    <a href='/profile/{{ $matched_users_relation->toUser->id }}'>
                        <p class='user_name'>ユーザー名　　　{{ $matched_users_relation->toUser->user_name }}</p>
                    </a>
                    <p class='age'>年齢　　　　　　{{ $matched_users_relation->toUser->age }}歳</p>
                    <p class='years_of_experience'>テニス歴　　　　{{ $matched_users_relation->toUser->years_of_experience}}年</p>
                    <br>
                </div>
            @endforeach
        </div>
        <button type="button">
            <a href="/">
                Back
            </a>
        </button>
    </body>
</html>
@endsection