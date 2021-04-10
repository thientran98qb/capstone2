@extends('admin.layouts.admin')
@section('title', 'Role')

@section('content')
@section('js')
    <script src="{{asset('admins/roles/add.js')}}"></script>
@endsection
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Role','childPage'=>'Add Role'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{route('admin.role.store')}}"  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Ten vai tro</label>
                        <input type="text" placeholder="name role" name="name_role" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Mo ta vai tro</label>
                        <textarea name="desc_role" id="" class="form-control" cols="20" rows="10"></textarea>
                    </div>
                    <label for="check_all">
                        <input type="checkbox" name="" class="checkall" id="check_all">
                        Check all
                    </label>
                    @foreach ($permissions as $permission)
                        <div class="card">
                            <h5 class="card-header bg-info">
                                <input type="checkbox" name="" class="checkbox_wrapper" id="{{$permission->id}}h">
                                <label for="{{$permission->id}}h">{{$permission->name}}</label>
                            </h5>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($permission->getPermission as $item)
                                        <div class="role_item col-md-3">
                                            <input type="checkbox" class="checkbox_children" name="permission_id[]" value="{{$item->id}}" id="{{$item->id}}p">
                                            <label for="{{$item->id}}p">{{ $item->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        <input type="submit" value="Add Role" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
