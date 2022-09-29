@extends('layouts.app')

@section('content')
<body>
    <h3 class="head-list">マッチングリクエスト</h3>
    <div class='profiles'>
        @foreach ($recieved_users_relations as $recieved_users_relation)
             <div class="list-profile">
                <div class="flex-index">
                    <div class="img-wrap-list">
                       <img src="{{ Storage::disk('s3')->url($recieved_users_relation->img_url) }}" art="画像が表示されません">
                    </div>
                    <div class="text-list">
                        <p class='user_name'>ユーザー名　　　　　<a href='/profile/{{ $recieved_users_relation->id }}'>{{ $recieved_users_relation->user_name }}</a></p>
                        <p class='years_of_experience'>テニス歴　　　　　　{{ $recieved_users_relation->years_of_experience}}年</p>
                    </div>
                    <div class="list-botton1">
                        <div class='matching_request'>
                            <form action="/matching_list" method="POST",  style="display:inline">
                                @csrf
                                <input type="hidden" name="to_user_id" value="{{ $recieved_users_relation->id }}">
                                <input type="hidden" name="matching_request" value="1">
                                <input type="hidden" name="page_request" value=1>
                                <button type="submit">
                                    承認する
                                </button>
                            </form>
                            <form action="/matching_list" method="POST",  style="display:inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="from_user_id" value="{{ $recieved_users_relation->id }}">
                                <input type="hidden" name="to_user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="page_request" value=1>
                                <button type="submit">
                                    拒否する
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h3 class="head-list">マッチングリスト</h3>
    <div class='profiles'>
        @foreach ($matched_users_relations as $matched_users_relation)
            <div class="list-profile">
                <div class="flex-index">
                    <div class="img-wrap-list">
                       <img src="{{ Storage::disk('s3')->url($matched_users_relation->toUser->img_url) }}" art="画像が表示されません">
                    </div>
                    <div class="text-list">
                        <p class='user_name'>ユーザー名　　　　　<a href='/profile/{{ $matched_users_relation->toUser->id }}'>{{ $matched_users_relation->toUser->user_name }}</a></p>
                        <p class='years_of_experience'>テニス歴　　　　　　{{ $matched_users_relation->toUser->years_of_experience}}年</p>
                    </div>
                    <div class="list-botton2">
                        @if(in_array($matched_users_relation->toUser->id, $chat_user_ids))
                            <button type="botton">
                                <a href="/chat/{{ $matched_users_relation->toUser->id }}">
                                    チャット
                                </a>
                            </button>
                        @else
                            <form action="/chat/{user}" method="POST">
                                @csrf
                                <input type="hidden" name="the_other_id" value="{{ $matched_users_relation->toUser->id }}">
                                <input type="hidden" name="function_num" value=0>
                                <button type="submit">
                                    チャットを始める
                                </button>
                            </form>
                        @endif
                        <form action="/matching_list" method="POST",  style="display:inline">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="from_user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="to_user_id" value="{{ $matched_users_relation->toUser->id }}">
                            <input type="hidden" name="page_request" value=1>
                            <button type="submit">
                                削除
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="list-back-botton">
        <a href="/">
            戻る
        </a>
    </button>
</body>
@endsection