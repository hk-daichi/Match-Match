@extends('layouts.app')

@section('content')
<body>
    <h3 class="head-index">マッチング相手を探す</h3>
    <form method="GET" action="/">
        <div class="index-search">
            <div class="search_bar">
                <i class="fas fa-search search_icon"></i>
                <input id="text2" type="text" placeholder=" 利用施設" name="search" value="@if (isset($search)) {{ $search }} @endif">
                <button class="botton1" type="submit"><i class="fa-solid fa-arrow-right search_icon"></i></button>
            </div>
        </div>
    </form>
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
    <div class="pagination link-center">
        {{ $users->links() }}
    </div>
</body>
@endsection