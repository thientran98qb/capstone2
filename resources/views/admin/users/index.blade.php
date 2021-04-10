@extends('admin.layouts.admin')
@section('title', 'User')
@section('js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('admins/setting/index.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'User','childPage'=>'User List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <a href="{{ route('admin.user.create')}}" class="btn btn-primary m-3">Add User</a>
      <div class="row ">
        <div class="card container-fluid p-3 border">
          <div class="col">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Active<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Trash<span class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form action="{{ route('admin.user.delete.force') }}" method="get"  onsubmit="return confirm('Do you really want to delete the form?');">
                @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="selectStatus">
                        @foreach ($list_act as $k => $value)
                            <option value="{{$k}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-ordered table-bordered table-checkall">
                  <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall" class="checkall">
                        </th>
                      <th>
                          stt
                      </th>
                      <th>User name</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $stt => $user)
                        <tr>
                            <td>
                                <input type="checkbox" name="list_check[]" value="{{ $user->id }}" >
                            </td>
                            <td>{{ $stt+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-success">Edit</a>
                            @if (Auth::id() != $user->id)
                            <form action="{{ route('admin.user.destroy',$user->id) }}" method='post' class='d-inline delete_user'>
                                @csrf
                                <button type='submit' class='btn btn-danger' >Delete</button>
                            </form>
                            @endif
                            </td>
                        </tr>
                      @endforeach

                  </tbody>
                </table>
                <div class="col-sm-6">

                </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
