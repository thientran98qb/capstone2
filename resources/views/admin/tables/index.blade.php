@extends('admin.layouts.admin')
@section('title', 'Table')
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slide/index.css') }}">
@endsection
@section('js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('admins/slide/index.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Table','childPage'=>'Table List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <a href="{{route('admin.table.create')}}" class="btn btn-primary m-3">Add Table</a>
      <div class="row ">
        <div class="card container-fluid p-3 border">
          <div class="col">
            <table class="table table-ordered table-bordered ">
              <thead>
                <tr>
                  <th>
                      #
                  </th>
                  <th>Table name</th>
                  <th>Table description</th>
                  <th>Quantity</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($tables as $table)
                    <tr>
                        <td>{{ $table->id }}</td>
                        <td>{{ $table->name }}</td>
                        <td>{{ $table->description }}</td>
                        <td>{{ $table->quantity }}</td>
                        <td>{!! $table->status==0 ? "<span class='badge badge-success'>empty</span>": "<span class='badge badge-danger'>using</span>" !!}</td>
                        <td>
                        <a href="{{ route('admin.table.edit',$table->id)}}" class="btn btn-success">Edit</a>
                        <meta name='csrf-token' content=". csrf_token() .">
                        <a class='btn btn-danger text-white delete_table' data-url="{{route('admin.table.destroy',$table->id)}}">Delete</a>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
            <div class="col-sm-6">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
