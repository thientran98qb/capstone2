@extends('admin.layouts.admin')
@section('title', 'Product')
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/index.css') }}">
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('admins/product/index/index.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Product','childPage'=>'Product List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <a href="{{ route('admin.product.create') }}" class="btn btn-primary m-3">Add Product</a>
      <div class="row ">
        <div class="card container-fluid p-3 border">
          <div class="col">
            <table class="table table-ordered table-bordered ">
              <thead>
                <tr>
                  <th>
                      #
                  </th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Images</th>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ number_format($product->price) }}</td>
                        <td>
                            <img src="{{ $product->product_image }}" alt="{{ $product->feature_image_name }}" class="img_product">
                        </td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>
                        <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-success">Edit</a>
                        <meta name='csrf-token' content=". csrf_token() .">
                        <a class='btn btn-danger action_delete' data-url="{{ route('admin.delete_product',$product->id) }}">Delete</a>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>

            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
