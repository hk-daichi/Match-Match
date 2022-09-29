@extends('layouts.app')

@section('content')
<body>
    <h2 class="head">{{ $user->user_name }}さんのプロフィール</h2>
    <div class="profile">
        <div class="flex">
            <div class="img-wrap">
                <img src="{{ Storage::disk('s3')->url($user->img_url) }}" art="画像が表示されません">
            </div>
            <table>
                <tr>
                    <th>ユーザー名</th><td>{{ $user->user_name }}</td>
                </tr>
                <tr>
                    <th>性別</th><td>@if($user->gender)男@else女@endif</td>
                </tr>
                <tr>
                    <th>年齢</th><td>{{ $user->age }}歳</td>
                </tr>
                <tr>
                    <th>利用施設</th><td>{{ $user->facility }}</td>
                </tr>
                <tr>
                    <th>テニス歴</th><td>{{ $user->years_of_experience}}年</td>
                </tr>
                <tr>
                    <th>実績</th><td>{{ $user->career }}</td>
                </tr>
                <tr>
                    <th>主な目的</th><td>{{ $user->purpose }}</td>
                </tr>
            </table>
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