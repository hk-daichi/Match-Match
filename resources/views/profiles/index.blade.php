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
            @foreach ($profiles as $profile)
                <div class='profile'>
                    <h2 class='name'>{{ $profile->name }}</h2>
                    <p class='age'>{{ $profile->age }}歳</p>
                    <p class='facility'>{{ $profile->facility }}</p>
                    <p class='years_of_experience'>{{ $profile->years_of_experience}}年</p>
                    <p class='career'>{{ $profile->career }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $profiles->links() }}
        </div>
    </body>
</html>
@endsection