@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('プロフィール情報編集') }}</div>

                <div class="card-body">
                    <form action="/my_profile/{{ Auth::user()->id }}"　method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <div class="img-wrap-edit">
                                <img src="{{ Storage::disk('s3')->url(Auth::user()->img_url) }}" art="画像が表示されません">
                            </div>
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('変更プロフィール画像') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" name="image" accept="image/jpeg,image/phg" class="col-form-label text-md-right mx-auto">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('ユーザー名') }}</label>
                            
                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user[user_name]" value="{{ Auth::user()->user_name }}" autofocus>

                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('年齢') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="user[age]" value="{{ Auth::user()->age }}">

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="facility" class="col-md-4 col-form-label text-md-right">{{ __('利用施設') }}</label>

                            <div class="col-md-6">
                                <input id="facility" type="text" class="form-control @error('facility') is-invalid @enderror" name="user[facility]" value="{{ Auth::user()->facility }}">

                                @error('facility')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="years_of_experience" class="col-md-4 col-form-label text-md-right">{{ __('テニス歴') }}</label>

                            <div class="col-md-6">
                                <input id="years_of_experience" type="number" class="form-control @error('years_of_experience') is-invalid @enderror" name="user[years_of_experience]" value="{{ Auth::user()->years_of_experience }}">

                                @error('years_of_experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="career" class="col-md-4 col-form-label text-md-right">{{ __('経歴') }}</label>

                            <div class="col-md-6">
                                <input id="career" type="text" class="form-control @error('career') is-invalid @enderror" name="user[career]" value="{{ Auth::user()->career }}">
                                @error('career')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="purpose" class="col-md-4 col-form-label text-md-right">{{ __('利用目的') }}</label>

                            <div class="col-md-6">
                                <input id="purpose" type="text" class="form-control @error('purpose') is-invalid @enderror" name="user[purpose]" value="{{ Auth::user()->purpose }}">

                                @error('purpose')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <div class="edit-store-botton">
                                    <button type="submit" class="btn btn-primary">
                                        変更を保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
