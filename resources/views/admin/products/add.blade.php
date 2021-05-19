@extends('admin.layouts.admin')
@section('title', 'Product')
@section('css')
    <link href='{{ asset('vendor/select2/select2.min.css')}}' rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admins/product/add/add_product.css') }}">
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Product','childPage'=>'Add Product'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{ route('admin.product.store') }}" enctype="multipart/form-data"  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Product name</label>
                        <input type="text" placeholder="Product name" name="product_name" value="{{ old('product_name') }}" class="form-control col-md-4  @error('product_name') is-invalid @enderror">
                    </div>
                    @error('product_name')
                        <div class="alert alert-danger col-md-4 ">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Image Thumb</label>
                        <input type="file" placeholder="Image Product" name="image_product" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Image Detail</label>
                        <input type="file" placeholder="Image Detail Product" multiple name="image_detail_product[]" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" placeholder="Price" value="{{ old('price') }}" name="price" class="form-control col-md-4 @error('price') is-invalid @enderror">
                    </div>
                    @error('price')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <label for="">Parent menu</label>
                    <div class="form-group">
                        <select name="parent_id" id="" required class="form-control col-md-4 category_name_js">
                            <option disabled selected>Select Category</option>
                            {!! $categories !!}
                        </select>
                    </div>
                    @error('parent_id')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <label for="">Tag name</label>
                    <div class="form-group">
                        <select class="form-control col-md-4 tag-select" name="tag_product[]" multiple="multiple">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="content" class="form-control col-md-4 my-editor @error('content') is-invalid @enderror"  id="" cols="30" rows="10">{{ old('content') }}</textarea>
                    </div>
                    @error('content')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="mt-4">
                        <input type="submit" value="Add Product" class="btn btn-warning">
                    </div>
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
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
   <script src="https://cdn.tiny.cloud/1/5vpl923wc92zcmi0pzv4l1jrq85qt6ulh8st9mu4osx7ywow/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
   <script src="{{ asset('admins/product/add/add_product.js') }}"></script>
@endsection
