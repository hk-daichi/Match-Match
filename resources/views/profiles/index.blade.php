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
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    </head>
    <body>
        <h2 class="head-index">プロフィール一覧</h2>
        <div class='profiles'>
            @foreach ($users as $user)
               @if($user != Auth::user())
                    <div class="index-profile">
                    　　<div class="flex-index">
                            <div class="img-wrap-index">
                               <img src="{{ Storage::disk('s3')->url($user->img_url) }}" art="画像が表示されません">
                            </div>
                            <div class="text-index">
                                <a href='/profile/{{ $user->id }}'>
                                    <p class='user_name'>ユーザー名　　　　　{{ $user->user_name }}</p>
                                </a>
                                <p class='age'>年齢　　　　　　　　{{ $user->age }}歳</p>
                                <p class='years_of_experience'>テニス歴　　　　　　{{ $user->years_of_experience}}年</p>
                                <p class='facility'>利用可能施設　　　　{{ $user->facility }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class='paginate'>
            {{ $users->links() }}
        </div>
    </body>
</html>
@endsection