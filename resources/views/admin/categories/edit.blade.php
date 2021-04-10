@extends('admin.layouts.admin')
@section('title', 'Category')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Category','childPage'=>'Edit Category'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{route('admin.category.update',$itemCategory->id)}}" method="post">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Category name</label>
                        <input type="text" name="category_name" value="{{ $itemCategory['category_name'] }}" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Parent category</label>
                        <select name="parent_id" id="" class="form-control col-md-4">
                           @if ($itemCategory['parent_id'] == 0)
                                <option selected value="0">Root</option>
                           @endif
                            {!! $htmlOptions !!}
                        </select>
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Edit Category" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
