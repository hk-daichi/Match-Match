@extends('layouts.app')

@section('content')
<body>
    <h2 class="head">{{ Auth::user()->user_name }}さんのプロフィール</h2>
    <div class="profile">
        <div class="flex">
            <div class="img-wrap">
                <img src="{{ Storage::disk('s3')->url(Auth::user()->img_url) }}" art="画像が表示されません">
            </div>
            <div class="text">
                <p class='user_name'>ユーザー名　　　{{ Auth::user()->user_name }}</p>
                <p class='gender'>性別　　　　　　@if(Auth::user()->gender)男@else女@endif</p>
                <p class='age'>年齢　　　　　　{{ Auth::user()->age }}歳</p>
                <p class='facility'>利用可能施設　　{{ Auth::user()->facility }}</p>
                <p class='years_of_experience'>テニス歴　　　　{{ Auth::user()->years_of_experience}}年</p>
                <p class='career'>実績　　　　　　{{ Auth::user()->career }}</p>
                <p class='purpose'>主な目的　　　　{{ Auth::user()->purpose }}</p>
            </div>
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="button">
                <a href="/my_profile/{{ Auth::user()->id }}/profile_edit">
                    プロフィール編集
                </a>
            </button>
        </div>
    </div>
</body>

@endsection