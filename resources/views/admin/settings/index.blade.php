@extends('admin.layouts.admin')
@section('title', 'Product')
@section('js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('admins/setting/index.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Setting','childPage'=>'Setting List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <a href="{{ route('admin.setting.create')}}" class="btn btn-primary m-3">Add Setting</a>
      <div class="row ">
        <div class="card container-fluid p-3 border">
          <div class="col">
            <table class="table table-ordered table-bordered ">
              <thead>
                <tr>
                  <th>
                      #
                  </th>
                  <th>Config key</th>
                  <th>Config name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($settings as $setting)
                    <tr>
                        <td>{{ $setting->id }}</td>
                        <td>{{ $setting->config_key }}</td>
                        <td>{{ $setting->config_value }}</td>
                        <td>
                        <a href="{{route('admin.setting.edit',$setting->id)}}" class="btn btn-success">Edit</a>
                        <meta name='csrf-token' content=". csrf_token() .">
                        <a class='btn btn-danger text-white delete_setting' data-url="{{route('admin.delete_setting',$setting->id)}}">Delete</a>
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
