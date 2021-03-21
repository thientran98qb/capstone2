@extends('admin.layouts.admin')
@section('title', 'Menu')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Menu','childPage'=>'Add Menu'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="" method="post">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Menu name</label>
                        <input type="text" placeholder="Ten menu" name="menu_name" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Parent menu</label>
                        <select name="parent_id" id="" class="form-control col-md-4">
                            <option selected disabled>Chon menu cha</option>
                            <option value="0">Root</option>
                            {!! $menus !!}
                        </select>
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Add Category" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
