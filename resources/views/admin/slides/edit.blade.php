@extends('admin.layouts.admin')
@section('title', 'Slide')
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slide/index.css') }}">
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Slide','childPage'=>'Edit Slide'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{route('admin.slide.update',$slide->id)}}" enctype="multipart/form-data"  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Slide name</label>
                        <input type="text" placeholder="Slide name" value="{{ $slide->name }}" name="slide_name" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Description slide</label>
                        <input type="text" placeholder="description slide" value="{{ $slide->description }}" name="desc_slide" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Image Slide</label>
                        <input type="file" placeholder="Image Slide" name="image_slide" class="form-control col-md-4">
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ $slide->image }}" class="image_slide" alt="">
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Edit Slide" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
