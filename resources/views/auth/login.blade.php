@extends('layouts.app')
@section('css')

<link rel="stylesheet" href="{{asset('frontend/assets/css/login.css')}}">
@endsection
@section('main')
<div class="main">
    <form action="{{route('login')}}" method="POST" class="form" id="form-2">
        @csrf
        @if(session()->has('errorLogin'))
            <div class="alert alert-danger">
                {{ session()->get('errorLogin') }}
            </div>
        @endif
        <h3 class="heading">Login</h3>
        <p class="desc">Let us serve you the best meals ❤️</p>

        <div class="spacer"></div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="text" placeholder="VD: hoainam@gmail.com" class="form-control">
            <span class="form-message"></span>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="form-group">
            <label for="password" class="form-label">password</label>
            <input id="password" name="password" type="password" placeholder="Your password" class="form-control">
            <span class="form-message"></span>
        </div>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <input type="submit" class="form-submit" value="Login">
        <a href="/register" class="register-link"><span> No account yet? </span> Signup </a>
        <div class="form-group">
            <div class="col-md-8">
                <a class="btn btn-link" href="{{ URL::to('auth/google') }}">
                    <i class="fa fa-google-plus-square" aria-hidden="true"></i> Đăng nhập bằng Google
                </a>
            </div>
        </div>
    </form>

</div>
@endsection
