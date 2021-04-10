@extends('admin.layouts.admin')
@section('title', 'Role')

@section('content')
@section('js')
    <script>
        $('.checkbox_wrapper').on('click',function(){
            $(this).parents('.card').find('.checkbox_children').prop('checked',$(this).prop('checked'));
        });
    </script>
@endsection
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Role','childPage'=>'Add Role'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{route('admin.role.update',$role->id)}}"  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Ten vai tro</label>
                        <input type="text" placeholder="name role" value="{{$role->name}}" name="name_role" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Mo ta vai tro</label>
                        <textarea name="desc_role" id="" class="form-control" cols="20" rows="10">{{$role->display_name}}</textarea>
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="card">
                            <h5 class="card-header bg-info">
                                <input type="checkbox" name="" class="checkbox_wrapper" >
                                {{$permission->name}}
                            </h5>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($permission->getPermission as $item)
                                        <div class="role_item col-md-3">
                                            <input type="checkbox"
                                            {{$checkedPermission->contains('id',$item->id) ? 'checked' : ''}}
                                             class="checkbox_children" name="permission_id[]" value="{{$item->id}}" id="">
                                            <span>{{ $item->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        <input type="submit" value="Edit Role" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
