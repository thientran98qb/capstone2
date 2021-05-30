@extends('admin.layouts.admin')
@section('title', 'Voucher')
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Voucher','childPage'=>'Edit Voucher'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{route('admin.voucher.update',$voucher->id)}}" method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Select Voucher Option</label>
                        <select name="type" class="form-control col-md-4">
                            <option selected disabled>Select Product</option>
                            <option value="percent">percent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Code Discount</label>
                        <input type="text" min="0"
                        name="code" value="{{$voucher->code}}" class="form-control col-md-4">
                    </div>
                    @error('code')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Percent Discount(%)</label>
                        <input type="number" min="0"  max="100"
                        name="percent" class="form-control col-md-4" value="{{$voucher->percent_off}}" >
                    </div>
                    @error('percent')
                    <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="mt-4">
                        <input type="submit" value="Update Voucher" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

