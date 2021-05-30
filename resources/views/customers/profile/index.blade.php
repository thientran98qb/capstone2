@extends('layouts.app')

@section('css')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('frontend/assets/css/profile.css')}}">
@endsection
@section('main')
<div class="container">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block" src="{{$user->avatar}}" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name">
                              {{$user->name}}
                            </li>
                            <li class="email"><a href="#">{{$user->email}}</a></li>

                        </ul>
                    </div>
            		<nav class="side-menu">
        				<ul class="nav">
        					<li class="active"><a href="#"><span class="fa fa-user"></span> Profile</a></li>

        				</ul>
        			</nav>
                </div>
                <div class="content-panel" style="margin-top: 100px">
                    @if (session()->has('error_pass'))
                    <p class="alert alert-danger">{{session()->get('error_pass')}}</p>
                    @endif
                    @if (session()->has('success_change'))
                    <p class="alert alert-success">{{session()->get('success_change')}}</p>
                    @endif
                    @if (session()->has('success_change_pass'))
                    <p class="alert alert-success">{{session()->get('success_change_pass')}}</p>
                    @endif
                    <h2 class="title">Profile</h2>
                    <form class="form-horizontal" action="{{route('customer.profile.avatar')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Personal Info</h3>
                            <div class="form-group avatar">

                                <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                    <input type="file" class="file-uploader pull-left" name="avatar">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">User Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="name_user" value="{{$user->name}}">
                                </div>
                            </div>

                        </fieldset>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input class="btn btn-primary" type="submit" value="Update Profile">
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" method="POST" action="{{route('customer.profile.pass')}}">
                        @csrf
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Personal Info</h3>

                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Old Password</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="password" name="old_password" class="form-control" placeholder="Old Password">
                                </div>
                                @error('old_password')
                                    <p class="text-danger text-center">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">New Password</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="password" name="new_password" class="form-control" placeholder="New Password">
                                </div>
                                @error('new_password')
                                    <p class="text-danger text-center">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Re New Password</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="password" name="re_password" class="form-control" placeholder="Re New Password">
                                </div>
                                @error('re_password')
                                    <p class="text-danger text-center">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </fieldset>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input class="btn btn-primary" type="submit" value="Update Password">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </div>
</div>
@endsection
