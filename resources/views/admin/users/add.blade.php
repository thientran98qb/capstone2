@extends('admin.layouts.admin')
@section('title', 'User')
@section('css')
    <link href='{{ asset('vendor/select2/select2.min.css')}}' rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admins/product/add/add_product.css') }}">
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'User','childPage'=>'Add User'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{route('admin.user.store')}}" enctype="multipart/form-data"  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">User name</label>
                        <input type="text" placeholder="User name" value="{{ old('user_name') }}"  name="user_name" class="form-control col-md-4 @error('user_name')
                        is-invalid
                        @enderror">
                    </div>
                    @error('user_name')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" placeholder="Email address" required
                        value="{{ old('email') }}" name="email" class="form-control col-md-4">
                    </div>
                    @error('email')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" placeholder="password"  name="password" class="form-control col-md-4  @error('password')
                        is-invalid
                        @enderror">
                    </div>
                    @error('password')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <label for="">Role name</label>
                    <div class="form-group">
                        <select class="form-control col-md-4 tag-select" name="roles[]" multiple="multiple">
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('roles')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="mt-4">
                        <input type="submit" value="Add User" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
   <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
   <script src="{{ asset('admins/product/add/add_product.js') }}"></script>
@endsection
