@extends('layouts.app')

@section('content')
<body>
    <h2 class="head">{{ Auth::user()->user_name }}さんのプロフィール</h2>
    <div class="profile">
        <div class="flex">
            <div class="img-wrap">
                <img src="{{ Storage::disk('s3')->url(Auth::user()->img_url) }}" art="画像が表示されません">
            </div>
            <table>
                <tr>
                    <th>ユーザー名</th><td>{{ Auth::user()->user_name }}</td>
                </tr>
                <tr>
                    <th>性別</th><td>@if(Auth::user()->gender)男@else女@endif</td>
                </tr>
                <tr>
                    <th>年齢</th><td>{{ Auth::user()->age }}歳</td>
                </tr>
                <tr>
                    <th>利用施設</th><td>{{ Auth::user()->facility }}</td>
                </tr>
                <tr>
                    <th>テニス歴</th><td>{{ Auth::user()->years_of_experience}}年</td>
                </tr>
                <tr>
                    <th>実績</th><td>{{ Auth::user()->career }}</td>
                </tr>
                <tr>
                    <th>主な目的</th><td>{{ Auth::user()->purpose }}</td>
                </tr>
            </table>
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