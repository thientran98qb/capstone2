@extends('layouts.app')
@section('css')

<link rel="stylesheet" href="{{asset('frontend/assets/css/detail.css')}}">
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('customers/cart/cart.js')}}"></script>
<script src="{{ asset('customers/product/comment.js') }}"></script>
@endsection
@section('main')
<div id="main">
    <div class="grid wide">
        <div class="row">
            <div class="detail-dish">
                <div class="col l-6 m-12 c-12">
                    <div class="detail-dish-img">
                        <img src="{{$product->product_image}}" alt="">
                    </div>
                </div>
                <div class="col l-6 m-12 c-12">
                    <div class="detail-dish__title">
                        <h2>{{$product->product_name}}</h2>
                        <p>Creamy Alfredo Sauce with Olive Oil & Roasted Garlic, Fresh Spinach, Chopped Onions, and Mushrooms, Baked with Mozzarella, Feta, and Parmesan Cheeses. Topped with Sliced, Toasted Almonds.</p>
                    </div>
                    <div class="add-cart-btn slider__btn">
                        <button class="data__btn slider__btn-add addcart"
                        data-id="{{$product->id}}" data-url="{{route('customer.add.cart',$product->id)}}">ADD TO CART</button>
                        <Span class="data__price slider__btn-price">From ${{$product->price}}</Span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col l-12 m-12 c-12">
                <div class="desc">
                    {!! $product->pnameroduct_description !!}
                </div>
            </div>
        </div>

        <div class="row">
          @include('customers.products.comment')
        </div>
    </div>
</div>
@endsection
