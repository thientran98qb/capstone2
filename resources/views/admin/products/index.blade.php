@extends('admin.layouts.admin')
@section('title', 'Product')

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
                  <tr>
                      <td>1</td>
                      <td>Iphone 3</td>
                      <td>2.40000.400</td>
                      <td></td>
                      <td>May Tinh</td>
                      <td>
                        <a href="" class="btn btn-success">Edit</a>
                        <meta name='csrf-token' content=". csrf_token() .">
                        <form action="" method='post' class='d-inline delete_menu'>
                            <button type='submit' class='btn btn-danger'>Delete</button>
                        </form>
                      </td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
