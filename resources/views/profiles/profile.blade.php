@extends('layouts.app')

@section('content')
<body>
    <h2 class="head">{{ $user->user_name }}さんのプロフィール</h2>
    <div class="profile">
        <div class="flex">
            <div class="img-wrap">
                <img src="{{ Storage::disk('s3')->url($user->img_url) }}" art="画像が表示されません">
            </div>
            <div class="text">
                <p class='user_name'>ユーザー名　　　{{ $user->user_name }}</p>
                <p class='gender'>性別　　　　　　@if($user->gender)男@else女@endif</p>
                <p class='age'>年齢　　　　　　{{ $user->age }}歳</p>
                <p class='facility'>利用可能施設　　{{ $user->facility }}</p>
                <p class='years_of_experience'>テニス歴　　　　{{ $user->years_of_experience}}年</p>
                <p class='career'>実績　　　　　　{{ $user->career }}</p>
                <p class='purpose'>主な目的　　　　{{ $user->purpose }}</p>
            </div>
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <div class='matching_request'>
                @if($matched)
                    <button type=button>
                        マッチング済み
                    </button>
                    @if($chat_room_existence)
                        <form action="/chat/{user}" method="POST">
                            @csrf
                            <input type="hidden" name="the_other_id" value="{{ $user->id }}">
                            <input type="hidden" name="function_num" value=0>
                            <button type="submit">
                                チャットを始める
                            </button>
                        </form>
                    @else
                        <button type="botton">
                            <a href="/chat/{{ $user->id }}">
                                チャット
                            </a>
                        </button>
                    @endif
                @elseif($sent)
                    <button type=button>
                        送信済み
                    </button>
                    <form action="/profile/{user}" method="POST",  style="display:inline">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="from_user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                        <input type="hidden" name="page_request" value=0>
                        <button type="submit">
                        リクエストを取り消す
                        </button>
                    </form>
                @else
                    <form action="/profile/{user}" method="POST">
                        @csrf
                        <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                        <input type="hidden" name="matching_request" value="1">
                        <input type="hidden" name="page_request" value=0>
                        <button type="submit">
                            マッチングリクエストを送る
                        </button>
                    </form>
                @endif
            </div>
            <button type="button" class="profile-back-botton">
                <a href="/">
                    戻る
                </a>
            </button>
        </div>
    </div>
</body>
@endsection