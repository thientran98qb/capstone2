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
            <table class="table table-ordered table-bordered ">
              <thead>
                <tr>
                  <th>Category name</th>
                  <th>Thumb</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                    {!! $tableRecusive !!}
              </tbody>
            </table>
          </div>
        </div>
        {{ $categories->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
