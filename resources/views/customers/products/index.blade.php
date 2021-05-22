@extends('layouts.app')
@section('css')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('frontend/assets/css/detail.css')}}">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
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
                        <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-show-caption="false" data-step="0.1" value="{{ $product->averageRating }}" data-size="xs" disabled="">
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
                        <Span class="data__price slider__btn-price"> {{number_format($product->price)}} VND</Span>
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
