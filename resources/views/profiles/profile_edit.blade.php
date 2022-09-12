@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form action="/my_profile/{{ Auth::user()->id }}"　method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user[user_name]" value="{{ Auth::user()->user_name }}" required autocomplete="user_name" autofocus>

                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="user[age]" value="{{ Auth::user()->age }}" required autocomplete="age" autofocus>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="facility" class="col-md-4 col-form-label text-md-right">{{ __('Facility') }}</label>

                            <div class="col-md-6">
                                <input id="facility" type="text" class="form-control @error('facility') is-invalid @enderror" name="user[facility]" value="{{ Auth::user()->facility }}" required autocomplete="facility" autofocus>

                                @error('facility')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="years_of_experience" class="col-md-4 col-form-label text-md-right">{{ __('Year of Experience') }}</label>

                            <div class="col-md-6">
                                <input id="years_of_experience" type="number" class="form-control @error('years_of_experience') is-invalid @enderror" name="user[years_of_experience]" value="{{ Auth::user()->years_of_experience }}" required autocomplete="years_of_experience" autofocus>

                                @error('years_of_experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="career" class="col-md-4 col-form-label text-md-right">{{ __('Career') }}</label>

                            <div class="col-md-6">
                                <input id="career" type="text" class="form-control @error('career') is-invalid @enderror" name="user[career]" value="{{ Auth::user()->career }}" required autocomplete="career" autofocus>

                                @error('career')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
