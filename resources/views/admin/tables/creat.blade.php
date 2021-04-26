@extends('admin.layouts.admin')
@section('title', 'Table')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Table','childPage'=>'Add Table'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{ route('admin.table.store') }}" method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Table name</label>
                        <input type="text" placeholder="Table name"  name="table_name" class="form-control col-md-4">

                    </div>
                    <div class="form-group">
                        <label for="">Description table</label>
                        <input type="text" placeholder="description table"   name="desc_table" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" min="0" max="20" name="quantity" class="form-control col-md-4">
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Add Slide" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
