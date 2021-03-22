@extends('admin.layouts.admin')
@section('title', 'Menu')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Menu','childPage'=>'Edit Menu'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{ route('admin.menu.update',$valueMenu['id']) }}" method="post">
                @method('PATCH')
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Menu name</label>
                        <input type="text" placeholder="Ten menu" name="menu_name" value="{{ $valueMenu['name'] }}" class="form-control col-md-4">
                        @error('menu_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Parent menu</label>
                        <select name="parent_id" id="" class="form-control col-md-4">
                            <option selected disabled>Chon menu cha</option>
                            @if ($valueMenu['parent_id'] == 0)
                                <option selected value="0">Root</option>
                            @endif
                            {!! $menus !!}
                        </select>
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Update Menu" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
