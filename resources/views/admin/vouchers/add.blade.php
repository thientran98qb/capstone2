@extends('admin.layouts.admin')
@section('title', 'Voucher')
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Voucher','childPage'=>'Add Voucher'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="" method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Select Product</label>
                        <select name="type" class="form-control col-md-4">
                            <option selected disabled>Select Product</option>
                            <option value="percent">percent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Code Discount</label>
                        <input type="text" min="0"
                        name="code" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Percent Discount</label>
                        <input type="number" min="0"
                        name="percent" class="form-control col-md-4">
                    </div>

                    <div class="mt-4">
                        <input type="submit" value="Add Voucher" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

