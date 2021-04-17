@extends('admin.layouts.admin')
@section('title', 'Permission')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Permission','childPage'=>'Add Permission'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="" method="post">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Parent permission</label>
                        <select name="permission_parent" id="" class="form-control col-md-4">
                            <option selected disabled>Choose permisison</option>
                            @foreach (config('permissions.table_module') as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="row">
                            @foreach (config('permissions.per_list') as $itemm)
                                <div class="role_item col-md-2">
                                    <input type="checkbox" class="checkbox_children" name="permission_child[]" value="{{$itemm}}">
                                    <label for="">{{$itemm}}</label>
                                </div>
                            @endforeach
                        </div>
                    <div class="mt-4">
                        <input type="submit" value="Add Permission" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
