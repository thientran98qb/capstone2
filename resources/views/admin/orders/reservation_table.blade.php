@extends('admin.layouts.admin')
@section('title', 'Orders')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('admins/product/index/index.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.content_header',['namePage'=>'Reservation','childPage'=>'Reservation order'])

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List customer reservation</h3>

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
                         Tên bàn
                      </th>
                      <th style="width: 15%">
                        Ngày order
                     </th>
                      <th>
                         Số điện thoại
                      </th>
                      <th style="width: 8%">
                        Email
                        </th>
                      <th style="width: 8%" class="text-center">
                          Số lượng
                      </th>
                      <th style="width: 10%" class="text-center">
                        Trạng thái
                        </th>
                      <th style="width: 16%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                 @foreach ($user_tables as $user_table)
                 <tr>
                    <td>
                        #
                    </td>
                    <td>
                       <p>{{$user_table->name}}</p>
                    </td>
                    <td>
                        <p>{{$user_table->table_name}}</p>
                     </td>
                    <td>
                        <div class="list-inline">
                            <p>{{$user_table->date}}</p>
                        </div>
                    </td>
                    <td class="project_progress">
                        <p>{{ $user_table->phone_number }}</p>
                    </td>
                    <td class="project_progress">
                        <p>{{ $user_table->email }}</p>
                    </td>
                    <td class="project-state">
                       {{$user_table->quantity}}
                    </td>
                    <td class="project-state">
                        <select class="form-control status_order" name="status_order" data-url="{{ route('admin.change.status') }}" data-id="{{ $user_table->id }}">
                            <option @if ($user_table->status == 0)
                                selected
                            @endif value="0">Khởi tạo</option>
                            <option @if ($user_table->status == 1)
                                selected
                            @endif value="1">Đang xử lý</option>
                            <option @if ($user_table->status == 2)
                                selected
                            @endif value="2">Hoàn thành</option>
                        </select>
                     </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="#">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </a>
                        <a class="btn btn-info btn-sm" href="">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <a class="btn btn-danger btn-sm delete_order">
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
