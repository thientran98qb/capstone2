@extends('admin.layouts.admin')
@section('title', 'Slide')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Slide','childPage'=>'Add Slide'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{ route('admin.slide.store') }}" enctype="multipart/form-data"  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Slide name</label>
                        <input type="text" placeholder="Slide name"  name="slide_name" class="form-control col-md-4 @error('slide_name')
                        is-invalid
                    @enderror">
                    @error('slide_name')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Description slide</label>
                        <input type="text" placeholder="description slide"   name="desc_slide" class="form-control col-md-4 @error('desc_slide')
                        is-invalid
                    @enderror">
                    </div>
                    @error('desc_slide')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Image Slide</label>
                        <input type="file" placeholder="Image Slide" name="image_slide" class="form-control col-md-4">
                    </div>
                    @error('image_slide')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror

                    <div class="mt-4">
                        <input type="submit" value="Add Slide" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
