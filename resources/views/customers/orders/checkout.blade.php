@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('frontend/assets/css/checkout.css')}}">
@endsection
@section('js')
    <script src="{{asset('js/reservation.js')}}"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>
@endsection
@section('main')
<div id="main">
    <div class="grid wide">
        <!-- data-aos="fade-up"  -->
        <div class="menu__title" >
            <div class="row">
                <div class="col l-12 m-0 c-0">
                    <div class="menu__top-img"></div>
                    <h1>Checkout</h1>
                    <h4>Some informations about our restaurant</h4>
                </div>
            </div>
        </div>

        <div class="menu__content">
            <div class="container">
                <form action="{{route('customer.orders')}}" method="post">
                    @csrf
                <div class="row">
                    <div class="col l-8 m-12 c-12">
                        @if (session()->has('success'))
                        <div class="alert alert-success" style="background-color: ">
                           {{ session()->get('success') }}
                        </div>
                        @endif
                        <div class="checkout">
                            <div class="checkout__title">
                                <h4 class="border-bottom">
                                    <i class="fas fa-user-edit"></i>
                                    Basic informations
                                </h4>
                            </div>
                            <div class="row ">
                                <div class="form-group">
                                    <div class="form-element col l-6 m-6 c-12">
                                        <label>Name:</label>
                                        <input type="text" name="fullname" class="form-control">
                                    </div>
                                    <div class="form-element col l-6 m-6 c-12">
                                        <label>Phone number:</label>
                                        <input type="text" name="phone_number" class="form-control">
                                    </div>
                                    <div class="form-element col l-12 m-12 c-12">
                                        <label>Street and number:</label>
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                    <div class="form-element col l-6 m-6 c-12">
                                        <label>City:</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-element col l-6 m-6 c-12">
                                        <label>E-mail address:</label>
                                        <input type="email" name="email_add" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="payment">
                                <h4 class="border-bottom">
                                    <i class="fas fa-money-check-alt"></i>
                                    Payment
                                </h4>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="form-element col l-4 m-4 c-12">
                                        <label class="custom-control">
                                            <input type="radio" name="payment_type" class="custom-control-input" value="Payment on delivery">
                                            <span class="custom-control-description">Payment on delivery</span>
                                        </label>
                                    </div>

                                    <div class="form-element col l-4 m-4 c-12">
                                        <label class="custom-control">
                                            <input type="radio" name="payment_type" class="custom-control-input" value="vnpay">
                                            <span class="custom-control-description">VN Pay</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                           {{-- <a href="" class="btn-payment">Payment online</a> --}}
                            <div class="delivery">
                                <h4 class="border-bottom">
                                    <i class="fas fa-truck"></i>
                                    Delivery
                                </h4>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="form-element col l-6 m-6 c-12">
                                        <label>Đặt bàn trước:</label>
                                        <div class="select">
                                            <select class="form-control" name="selectTable" id="mystuff">
                                                <option selected disabled>select</option>
                                                <option value="opt1">Đặt bàn trước</option>
                                                <option value="opt2">Không</option>
                                            </select>
                                            <i class="fas fa-arrow-down"></i>
                                        </div>
                                    </div>
                                    <div class="delivery_hide delivery_opt1">
                                        <div class="row ">
                                            <div class="form-group">
                                                <div class="form-element col l-6 m-6 c-12">
                                                    <label>Date:</label>
                                                    <input type="date" class="form-control" name="date_order_table">
                                                </div>
                                                <div class="form-element col l-6 m-6 c-12">
                                                    <label>Time:</label>
                                                    <input type="time" class="form-control" name="time_order_table">
                                                </div>
                                                <div class="form-element col l-6 m-6 c-12">
                                                    <label>Quantity:</label>
                                                    <select class="form-control" name = "quantity" id="selectQuantity" data-url="{{route('filter.table')}}">
                                                        <option value = "hour-select">Select quantity</option>
                                                        <option value = "2">2</option>
                                                        <option value = "4">4</option>
                                                        <option value = "6">6</option>
                                                        <option value = "8">8</option>
                                                    </select>
                                                </div>
                                                <div class="form-element col l-6 m-6 c-12">
                                                    <label>Table name:</label>
                                                    <select class="form-control" name = "table" id="opt_table">
                                                        <option value = "hour-select">Select table</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col l-4 m-12 c-12">
                        <div class="bill">
                            <h4 class="bill-cart-heading">
                                Your Cart
                            </h4>
                            <ul class="cart-list-item">
                               @if (session()->has('cart'))
                               @foreach ($carts as $cart)
                               <li class="cart-item">
                                   <input type="hidden" name="product_id[]" value="{{$cart['id']}}">
                                   <input type="hidden" name="quantity[]" value="{{$cart['quantity']}}">
                                   <input type="hidden" name="price[]" value="{{$cart['price']}}">
                                   <img src="{{$cart['img']}}" alt="" class="cart-item-img">
                                   <div class="bill-cart-info cart-info">
                                       <div class="cart-info-text">
                                           <h5 class="cart-info-name">{{$cart['product_name']}}</h5>
                                           <span class="cart-info-quantily" >{{$cart['quantity']}}</span>
                                           <span class="cart-info-x">x</span>
                                           <span class="cart-info-price">${{$cart['price']}}</span>
                                       </div>
                                       <span class="cart-info-price">${{$cart['total_price']}}</span>
                                       <div class="cart-info-remove">
                                           <i class="fas fa-times"></i>
                                       </div>
                                   </div>
                               </li>
                               @endforeach
                               @endif

                                <div class="bill__sumary">
                                    <div class="row mg-bottom f-end">
                                        <div class="col l-7 text-right">
                                            Order total:
                                        </div>
                                        <div class="col l-5">
                                            @php
                                                $total = 0;
                                                foreach ($carts as $cart){
                                                    $total += $cart['total_price'];
                                                }
                                            @endphp
                                            <span class="bill__sumary-product">${{$total}}</span>
                                            <input type="hidden" name="amount" value="{{$total}}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row f-end">
                                        <div class="col l-7 text-right">
                                            Devliery:
                                        </div>
                                        <div class="col l-5">
                                            <span class="bill__sumary-product">$0</span>
                                        </div>
                                    </div>
                                    <div class="row f-end">
                                        <div class="col l-7 text-right">
                                            Total:

                                        </div>
                                        <div class="col l-5">
                                            <input type="hidden" name="total_price" value="{{$total}}">
                                            <span class="bill__sumary-product" >${{$total}}</span>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col l-12 m-12 c-12">
                        <button class="order-btn">
                            <span>Order now!</span>
                        </button>
                    </div>

                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
