@extends('admin.layouts.admin')
@section('title', 'Orders')
@section('js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('admins/product/index/index.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.content_header',['namePage'=>'Order','childPage'=>'List order'])

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Tên người orders
                      </th>
                      <th style="width: 15%">
                          Team Members
                      </th>
                      <th>
                          Địa chỉ
                      </th>
                      <th>
                        Payments
                        </th>
                      <th style="width: 8%">
                        Email
                        </th>
                      <th style="width: 8%" class="text-center">
                          Status
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                 @foreach ($bills as $bill)
                 <tr>
                    <td>
                        #
                    </td>
                    <td>
                       <p>{{$bill->user->name}}</p>
                    </td>
                    <td>
                        <div class="list-inline">
                            <p>{{$bill->date_order}}</p>
                        </div>
                    </td>
                    <td class="project_progress">
                        <p>{{ $bill->address }}</p>
                    </td>
                    <td class="project_progress">
                        @if ($bill->paymentt)
                            <ul>
                                <li>Ngân hàng: {{ $bill->paymentt->code_bank}}</li>
                                <li>Mã thanh toán: {{ $bill->paymentt->code_vnpay}}</li>
                                <li>Nội dung: {{ $bill->paymentt->note}}</li>
                                <li>Tổng tiền: {{ $bill->paymentt->money}} VNĐ</li>
                                <li>Thời gian: {{ date('Y-m-d H:i',strtotime($bill->paymentt->time)) }}</li>
                            </ul>
                        @else
                            <p>Thanh toán khi nhận hàng</p>
                        @endif
                    </td>
                    <td class="project_progress">
                        <p>{{ $bill->user->email }}</p>
                    </td>
                    <td class="project-state">
                        @if ($bill->note == 'done')
                        <span class="badge badge-success">Success</span>
                        @elseif($bill->note =='pending')
                        <span class="badge badge-warning">Pending</span>
                        @else
                        <span class="badge badge-danger">Wating....</span>
                        @endif
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.order.edit',$bill->id)}}">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </a>
                        <a class="btn btn-danger btn-sm delete_order"
                        data-url="{{route('admin.order.destroy',$bill->id)}}">
                            <i class="fas fa-trash">
                            </i>
                            Delete
                        </a>
                    </td>
                </tr>
                 @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection
