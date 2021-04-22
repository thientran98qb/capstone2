@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('frontend/assets/css/login.css')}}">
@endsection
@section('main')
<div class="main">

    <form method="POST"  action="{{ route('register') }}" class="form" id="form-1">
        @if (Session::has('register_succes'))
            <p class="heading" style="color: red;padding: 20px;">{{ Session::get('register_succes') }}</p>
        @endif
        @csrf
        <h3 class="heading">Register</h3>
        <p class="desc">Let us serve you the best meals ❤️</p>

        <div class="spacer"></div>

        <div class="form-group">
            <label for="name" class="form-label">name</label>
            <input id="name" name="name" type="text" required autocomplete="name" autofocus placeholder="VD: Lê Hoài Nam" class="form-control" value="{{ old('name') }}">
            <span class="form-message"></span>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="text" placeholder="VD: hoainam@gmail.com" value="{{ old('email') }} "class="form-control">
            <span class="form-message"></span>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" name="password" type="password" value="{{ old('password') }}" placeholder="Your password" class="form-control">
            <span class="form-message"></span>
        </div>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Enter your password</label>
            <input id="password-confirm" name="password_confirmation" placeholder="Enter your password" type="password" class="form-control">
            <span class="form-message"></span>
        </div>
        <input type="submit" class="form-submit" value="Sign up">
        <a href="/login" class="register-link">Already have an account? </a>
    </form>

</div>
@endsection
