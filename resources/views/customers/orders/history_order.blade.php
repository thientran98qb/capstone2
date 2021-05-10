@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('frontend/assets/css/order.css')}}">
@endsection
@section('main')
<div id="main">
    <p style="margin:0 auto;width:63%;background-color:#d4edda;
    padding:10px 10px;">Hien co {{ count($bills) }} don hang</p>
    @foreach ($bills as $bill)
    <div class="grid wide">
        <div class="row">
            <div class="col l-12 m-12 c-12 ">
                <div class="order-date">
                    <h2>Ordered:
                        <span>Date: {{$bill->updated_at}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l-12 m-12 c-12">
                <div class="infor">
                    <h2>Receivers information</h2>
                    <p>Name: {{$bill->user->name}}</p>
                    <p>Phone: {{$bill->phone_number}}</p>
                    <p>Email: {{$bill->user->email}}</p>
                    <p>Adddress: {{$bill->address}}</p>
                    <p>Table: </p>
                    <p>Quantity: </p>
                    <p>Payments: Payment on delivery</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col l-12 m-12 c-12">
               @foreach ($bill->products as $bill_detail)
               <div class="your-ord">

                <div class="product-img">
                    <img src="{{ $bill_detail->product_image }}" alt="">
                </div>
                <div class="product-infor">
                    <div class="cart-info-text">
                        <h5 class="cart-info-name">{{ $bill_detail->product_name }}</h5>
                        <span class="cart-info-quantily">{{ $bill_detail->pivot->quantity }}</span>
                        <span class="cart-info-x">x</span>
                        <span class="cart-info-price">${{ $bill_detail->price }}</span>
                    </div>
                </div>
                <div class="product-price">
                    <span>$@php
                      echo  $bill_detail->pivot->desc * $bill_detail->pivot->quantity
                    @endphp</span>
                </div>
            </div>
               @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col l-12 m-12 c-12">
                <div class="bill__sumary">
                    <div class="row mg-bottom f-end">
                        <div class="col l-8 text-right">
                            Order total:
                        </div>
                        <div class="col l-4">
                            <span class="bill__sumary-product">${{$bill->total_price}}</span>
                        </div>
                    </div>
                    <div class="row f-end">
                        <div class="col l-8 text-right">
                            Devliery:
                        </div>
                        <div class="col l-4">
                            <span class="bill__sumary-product">0</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row f-end">
                        <div class="col l-8 text-right">
                            Total:

                        </div>
                        <div class="col l-4">
                            <span class="bill__sumary-product">${{$bill->total_price}}</span>
                        </div>
                    </div>
                    {{-- <a href="#" class="cart-btn total-btn">
                        <span>Back</span>
                    </a> --}}
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
