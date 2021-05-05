@extends('admin.layouts.admin')
@section('title', 'Category')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Category','childPage'=>'Add Category'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{route('admin.category.store')}}" enctype="multipart/form-data" method="post">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Category name</label>
                        <input type="text" placeholder="Ten danh muc" name="category_name" value="{{ old('category_name') }}" class="form-control col-md-4">
                        @error('category_name')
                            <div class="alert col-sm-3 alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Parent category</label>
                        <select name="parent_id" id="" class="form-control col-md-4">
                            <option selected disabled>Chon danh muc cha</option>
                            <option value="0">Root</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Image Thumb</label>
                        <input type="file" placeholder="Image Category" name="image_category" class="form-control col-md-4">
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Add Category" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
