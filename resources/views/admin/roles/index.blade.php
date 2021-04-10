@extends('admin.layouts.admin')
@section('title', 'Role')
@section('js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('admins/setting/index.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Role','childPage'=>'Role List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <a href="{{ route('admin.role.create')}}" class="btn btn-primary m-3">Add Role</a>
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
                  @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>
                        <a href="{{route('admin.role.edit',$role->id)}}" class="btn btn-success">Edit</a>
                        <meta name='csrf-token' content=". csrf_token() .">
                        <form action="{{ route('admin.role.destroy',$role->id) }}" method='post' class='d-inline' onsubmit="return confirm('Do you want delete this role ???');">
                            @csrf
                            <button type='submit' class='btn btn-danger' >Delete</button>
                        </form>
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
