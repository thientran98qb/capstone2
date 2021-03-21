@extends('admin.layouts.admin')
@section('title', 'Menu')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Menu','childPage'=>'Menu List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <a href="{{ route('admin.menu.create')}}" class="btn btn-primary m-3">Add Category</a>
      <div class="row ">
        <div class="card container-fluid p-3 border">
          <div class="col">
            <table class="table table-ordered table-bordered ">
              <thead>
                <tr>
                  <th>Menu name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                    {!! $menuIndex !!}
              </tbody>
            </table>
          </div>
        </div>
        {{--  {{ $categories->links() }}  --}}
      </div>
    </div>
  </div>
</div>
@endsection
