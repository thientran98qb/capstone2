@extends('admin.layouts.admin')
@section('title', 'Voucher')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Voucher','childPage'=>'Voucher List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <a href="{{ route('admin.voucher.create') }}" class="btn btn-primary m-3">Add Voucher</a>
      <div class="row ">
        <div class="card container-fluid p-3 border">
          <div class="col">
            <table class="table table-ordered table-bordered ">
              <thead>
                <tr>
                  <th>
                      #
                  </th>
                  <th>Voucher code</th>
                  <th>Type</th>
                  <th>Discount percent</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->id }}</td>
                        <td>{{ $voucher->code }}</td>
                        <td>
                            {{ $voucher->type }}
                        </td>
                        <td>
                            {{ $voucher->percent_off }}%
                        </td>
                        <td>
                            <a href="{{ route('admin.voucher.edit',$voucher->id) }}" class="btn btn-success">Edit</a>
                        <form action="{{ route('admin.voucher.delete',$voucher->id) }}" method="POST" onsubmit="return confirm('Do you want to delete?');">
                            @csrf
                            <input class='btn btn-danger text-white' type="submit" value="Delete">
                        </form>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
            <div class="col-sm-6">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
