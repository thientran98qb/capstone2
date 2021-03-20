@extends('admin.layouts.admin')
@section('title', 'Category')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Category','childPage'=>'Category List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <a href="{{ route('admin.category.create')}}" class="btn btn-primary m-3">Add Category</a>
      <div class="row ">
        <div class="card container-fluid p-3 border">
          <div class="col">
            <table class="table table-ordered table-bordered text-center">
              <thead>
                <tr>
                  <th>Stt</th>
                  <th>Category name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    @foreach ($categories as $key => $category)
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <a href="" class="btn btn-success">Edit</a>
                            <form action="" method="post" class="d-inline">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    @endforeach
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
