@extends('admin.layouts.admin')
@section('title', 'Product')
@section('css')
    <link href='{{ asset('vendor/select2/select2.min.css')}}' rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admins/product/add/add_product.css') }}">
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Product','childPage'=>'Edit Product'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{ route('admin.product.update',$productItem->id) }}" enctype="multipart/form-data"  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Product name</label>
                        <input type="text" placeholder="Product name" value="{{ $productItem->product_name }}" name="product_name" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Image Thumb</label>
                        <input type="file" placeholder="Image Product" name="image_product" class="form-control col-md-4">
                    </div>
                    <div class="col-md-3">
                        <img src="{{ $productItem->product_image }}" class="image_edit_product" alt="">
                    </div>
                    <div class="form-group">
                        <label for="">Image Detail</label>
                        <input type="file" placeholder="Image Detail Product" multiple name="image_detail_product[]" class="form-control col-md-4">
                    </div>
                    <div class="col-md-12">
                        @foreach ($productItem->images as $item)
                            <img src="{{ $item->image_path }}" class="image_edit_product" alt="">
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text"  placeholder="Price" value="{{ $productItem->price }}" name="price" class="form-control col-md-4">
                    </div>
                    <label for="">Parent menu</label>
                    <div class="form-group">
                        <select name="parent_id" id="" class="form-control col-md-4 category_name_js">
                            <option value="0">Root</option>
                            {!! $categories !!}
                        </select>
                    </div>
                    <label for="">Tag name</label>
                    <div class="form-group">
                        <select class="form-control col-md-4 tag-select" name="tag_product[]" multiple="multiple">
                            @foreach ($productItem->tags as $tag)
                                <option value="{{ $tag->tag_name }}" selected>{{ $tag->tag_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="content" class="form-control col-md-4 my-editor"  id="" cols="30" rows="10">
                            {{ $productItem->product_description }}
                        </textarea>
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Update Product" class="btn btn-warning">
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
