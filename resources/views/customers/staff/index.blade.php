@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('frontend/assets/css/staff.css')}}">
@endsection
@section('js')
    <script src="{{ asset('js/staff.js') }}"></script>
@endsection
@section('main')
<div id="main">
    <div class="grid wide">
        <div class="row">
            <div class="col l-6 m-6 c-12">
                <div class="table-staff">
                    <div class="row">
                       @foreach ($tables as $table)
                       <div class="col l-4 m-4 c-4">
                        <button class="table-btn" data-url="{{route('fill.order')}}" data-id="{{$table->id}}" {{ $table->status==1 ? 'disabled' : '' }}>{{ $table->name }} ({{ $table->status==1 ? 'Fulled' : 'Empty' }})</button>
                        </div>
                       @endforeach

                    </div>
                </div>
            </div>

            <div class="col l-6 m-6 c-12">
                <div class="control">
                    <div class="row">
                        <div class="col l-9 m-8 c-8">
                            <div class="select">
                                <select class="form-control category" name="category" data-url="{{route('filter.food')}}">
                                    <option selected disabled>Select Category</option>
                                   @foreach ($categories as $category)
                                       <option value="{{$category->id}}">
                                           {{$category->category_name}}
                                       </option>
                                   @endforeach
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="col l-3 m-4 c-4">
                            <input class="number-select" id="amount" type="number" min="1" value="1" max="20" step="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l-9 m-8 c-8">
                            <div class="select">
                                <select class="form-control food">

                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="col l-3 m-4 c-4">
                            <button class="add-control" data-url="{{route('add.menu')}}">add food</button>
                        </div>
                    </div>
                    <div class="table-control">
                        <table id="menu-list">
                            <tr>
                              <th>Name</th>
                              <th>Price</th>
                              <th>Amount</th>
                              <th>Money</th>
                              <th>Action</th>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col l-12 m-12 c-12">
                <div class="end-control">
                    <label>Total:</label>
                    <div class="total-cost">0</div>
                    <button class="payment-control update-bill">Update</button>
                    <a class="payment-control" href="{{route('bill.order')}}">Payment</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
