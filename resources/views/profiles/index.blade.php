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
            <div class="index-profile">
            　　<div class="flex-index">
                    <div class="img-wrap-index">
                       <img src="{{ Storage::disk('s3')->url($user->img_url) }}" art="画像が表示されません">
                    </div>
                    <table>
                        <tr>
                            <th>ユーザー名</th><td><a href='/profile/{{ $user->id }}'>{{ $user->user_name }}</a></td>
                        </tr>
                        <tr>
                            <th>年齢</th><td>{{ $user->age }}歳</td>
                        </tr>
                        
                        <tr>
                            <th>テニス歴</th><td>{{ $user->years_of_experience}}年</td>
                        </tr>
                        <tr>
                            <th>利用施設</th><td>{{ $user->facility }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination-link-position">
        <div class="pagination link-center">
            {{ $users->links() }}
        </div>
    </div>
</body>
@endsection