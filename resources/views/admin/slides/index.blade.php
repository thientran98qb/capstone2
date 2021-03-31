@extends('admin.layouts.admin')
@section('title', 'Product')
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slide/index.css') }}">
@endsection
@section('js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('admins/slide/index.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Slide','childPage'=>'Slide List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <a href="{{ route('admin.slide.create') }}" class="btn btn-primary m-3">Add Slide</a>
      <div class="row ">
        <div class="card container-fluid p-3 border">
          <div class="col">
            <table class="table table-ordered table-bordered ">
              <thead>
                <tr>
                  <th>
                      #
                  </th>
                  <th>Slide name</th>
                  <th>Slide description</th>
                  <th>Images</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($slides as $slide)
                    <tr>
                        <td>{{ $slide->id }}</td>
                        <td>{{ $slide->name }}</td>
                        <td>{{ $slide->description }}</td>
                        <td>
                            <img src="{{ $slide->image }}" class="img_product image_slide">
                        </td>
                        <td>
                        <a href="{{route('admin.slide.edit',$slide->id)}}" class="btn btn-success">Edit</a>
                        <meta name='csrf-token' content=". csrf_token() .">
                        <a class='btn btn-danger text-white delete_slide' data-url="{{route('admin.delete_slide',$slide->id)}}">Delete</a>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
            <div class="col-sm-6">
                {{ $slides->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
