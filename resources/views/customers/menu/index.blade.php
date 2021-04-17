@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/menu.css')}}">
@endsection
@section('main')
<div class="grid wide">
    <div class="menu__title" data-aos="fade-up">
        <div class="row">
            <div class="col l-12 m-0 c-0">
                <h1>Menu list</h1>
                <h4>Some informations about our restaurant</h4>
            </div>
        </div>
    </div>
    <div class="menu__content">
        <div class="row">
            <div class="col l-3 m-3 c-0">
                <div class="bar" data-aos="fade-up">
                    <ul class="bar__list">
                        @foreach ($categories as $category)
                        <li class="bar__item">
                            <a href="#cate-{{$category->id}}">{{$category->category_name}}</a>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>

            <div class="col l-9 m-9 c-12">
                @foreach ($categories as $category)
                <div id="cate-{{$category->id}}" class="menu__top" data-aos="fade-up">
                    <div class="menu__top-title">
                        <div class="menu__top-img pt-img">
                            <!-- <img src="./assets/img/menu-burgers.jpg" alt=""> -->
                        </div>
                        <h2>{{$category->category_name}}</h2>
                    </div>
                    <div class="menu__list">
                        @foreach ($category->products as $product)
                        <div class="menu__list-item">
                            <div class="row">
                                <div class="col l-6 m-6 c-6 menu-list-left">
                                    <a href="#">
                                        <h6>{{$product->product_name}}</h6>
                                        <span>Beef, cheese, potato, onion, fries</span>
                                    </a>
                                </div>
                                <div class="col l-6 m-6 c-6 menu-list-right">
                                    <span class="menu-price">
                                        ${{$product->price}}
                                    </span>
                                    <button class="data__btn menu-btn">ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<div class="margin"></div>
@endsection
