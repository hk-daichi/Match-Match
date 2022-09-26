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
        <link href="{{ asset('css/balloon.css') }}" rel="stylesheet">
    </head>
    <body class="w-4/5 md:w-3/5 lg:w-2/5 m-auto">
        <div class="line-bc">
            <div class="row justify-content-center">
            <h3>{{ $user->user_name }}さんとのチャット</h3>
        </div>
            @foreach ($chat_room_messages as $message)
                <!--②左コメント始-->
                @if($message->user_id!=Auth::user()->id)
                    <div class="small">
                        <p class="text-left">{{$message->created_at}}＠{{$message->user->user_name}}</p>
                    </div>
                    <div class="balloon">
                        <div class="faceicon">
                            <img src="{{ Storage::disk('s3')->url($message->user->img_url) }}" art="">
                        </div>
                        <div class="chatting">
                            <div class="says">
                                <p>{{$message->message}}</p>
                            </div>
                        </div>
                    </div>
                <!--②/左コメント終-->
                @else
                <!--③右コメント始-->
                    <div class="small">
                        <p class="text-right">{{$message->created_at}}＠{{$message->user->user_name}}</p>
                    </div>
                    <div class="mycomment">
                        <p>{{$message->message}}</p>
                    </div>
                @endif
                <!--④右コメント終-->
            @endforeach
        <form class="my-4 py-2 px-4 rounded-lg bg-gray-300 text-sm flex flex-col md:flex-row flex-grow" action="/chat/{user}" method="POST">
            @csrf
            <input type=hidden name="chat_room_id" value={{ $chat_room_id }}>
            <input type=hidden name="the_other_id" value={{ $user->id }}>
            <input type=hidden name="function_num" value=1>
            <textarea class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded flex-auto" name="message" placeholder="Input message." maxlength="200"></textarea>
            <button class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded text-center bg-gray-500 text-white" type="submit">Send</button>
        </form>
        </div><!--/①LINE会話終了-->
    </body>
@endsection