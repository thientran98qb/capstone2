@extends('admin.layouts.admin')
@section('content')
<div class="content-wrapper">
    @include('admin.partials.content_header',['namePage'=>'Order','childPage'=>'detail order'])

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Thông tin khách hàng</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Thông tin người đặt hàng</th>
                      <th>{{ $bill->user->name }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Ngày đặt hàng</td>
                      <td>{{$bill->date_order}}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td>{{$bill->phone_number}}</td>
                      </tr>
                      <tr>
                        <td>Địa chỉ</td>
                        <td>{{$bill->address}}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>{{$bill->user->email}}</td>
                      </tr>
                      <tr>
                        <td>Hình thức thanh toán</td>
                        <td>{{ $bill->payment }}</td>
                      </tr>
                      <tr>
                        <td>Ghi chú</td>
                        <td></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0" style="height: 350px;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên sản phẩm</th>
                      <th>Image</th>
                      <th>Số lượng</th>
                      <th>Giá tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($detail_bill->products as $key => $detail)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$detail->product_name}}</td>
                            <td>
                                <img src="{{ $detail->product_image }}" alt="{{ $detail->feature_image_name }}" style="width: 200px;max-height:100px">
                            </td>
                            <td>
                                {{ $detail->pivot->quantity}}
                            </td>
                            <td>{{$detail->price}}</td>
                          </tr>
                        @endforeach
                        <tr>
                            <td colspan="4"><b>Tổng tiền</b></td>
                            <td colspan="1"><b class="text-red">{{ $detail_bill->total_price }}$</b></td>
                        </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            <div class="col-md-12">
                <form action="{{ route('admin.update.status',$detail_bill->id)}}" method="POST">
                    @csrf
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                    <div class="form-inline">
                        <label>Trạng thái giao hàng: </label>
                        <select name="status" class="form-control input-inline" style="width: 200px">
                            <option value="wait">Chưa giao</option>
                            <option value="pending">Đang giao</option>
                            <option value="done">Đã giao</option>
                        </select>

                        <input type="submit" value="Xử lý" class="btn btn-primary">
                    </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
