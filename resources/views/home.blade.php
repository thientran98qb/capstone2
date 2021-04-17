@extends('layouts.app')
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script src="{{asset('customers/cart/cart.js')}}"></script>
@endsection
@section('main')
    @include('customers.particular.slider',['slides' => $slides])
        <div id="main">
            <!-- about us  -->
            <div class="about" data-aos="fade-up">
                <div class="grid wide">
                    <div class="row">
                        <div class="col l-5 m-0 c-0"></div>
                        <div class="col l-7 m-12 c-12">
                            <div class="about__title" >
                                <h1>About Us</h1>
                                <h4>Some informations about our restaurant</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col l-5 m-12 c-0">
                            <img src="{{asset('frontend/assets/img/about.jpg')}}" alt="" class="about__img">
                        </div>

                        <div class="col l-7 m-12 c-12">
                            <div class="about__content">
                                <h2>The best food in Da Nang!</h2>
                                <p>We offer meals of excellent quality and invite you to try our delicious food.</p>
                                <p> The key to our success is simple: providing quality consistent food that taste great every single time. We pride ourselves on serving our customers delicious genuine dishes like: Vietnamese</p>
                                <p>Eat delicious food. Grab a drink. But most of all, relax! We thank you from the bottom of our hearts for your continued support.</p>
                                <h4>What people say about Us?</h4>
                                <a href="#" class="about__btn">
                                    <span>Check our reviews</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col l-12 m-12 c-12">
                            <div class="about__end" data-aos="fade-up">
                                <img src="{{asset('frontend/assets/img/about2.jpg')}}" alt="" class="about__end-img">
                                <div class="about__text">
                                    <h2>Would you like to visit Us?</h2>
                                    <h5>Book a table even right now or make an online order!</h5>
                                    <a href="./menu.html" class="about__end-btn">
                                        <span>Order Online</span>
                                    </a>
                                    <a href="#" class="about__end-btn">
                                        <span>Book a table</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- popular menu  -->
            <div class="popular" data-aos="fade-up">
                <h2 class="popular__title">WHAT’S POPULAR</h2>
                <h6 class="popular__desc">Clients’ Most Popular Choise</h6>
                <div class="grid wide">
                    <div class="row">
                        <div class="col l-3 m-4 c-12">
                            <div class="popular__list">
                                <img src="{{asset('frontend/assets/img/item1.jpg')}}" alt="" class="list__img">
                                <div class="list__data">
                                    <a href="#" class="data__category">Fish</a>
                                    <h3 class="data__name">
                                        Pizza Margherita
                                    </h3>
                                    <p class="data__desc">With basil, mozzarella, tomatoes</p>
                                    <div class="add-cart-btn">
                                        <button class="data__btn">ADD TO CART</button>
                                        <Span class="data__price">From $9.98</Span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col l-3 m-4 c-12">
                            <div class="popular__list">
                                <img src="{{asset('frontend/assets/img/item2.jpg')}}" alt="" class="list__img">
                                <div class="list__data">
                                    <a href="#" class="data__category">Fish</a>
                                    <h3 class="data__name">
                                        Pizza Margherita
                                    </h3>
                                    <p class="data__desc">With basil, mozzarella, tomatoes</p>
                                    <div class="add-cart-btn">
                                        <button class="data__btn">ADD TO CART</button>
                                        <Span class="data__price">From $9.98</Span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col l-3 m-4 c-12">
                            <div class="popular__list">
                                <img src="{{asset('frontend/assets/img/item3.jpg')}}" alt="" class="list__img">
                                <div class="list__data">
                                    <a href="#" class="data__category">Fish</a>
                                    <h3 class="data__name">
                                        Pizza Margherita
                                    </h3>
                                    <p class="data__desc">With basil, mozzarella, tomatoes</p>
                                    <div class="add-cart-btn">
                                        <button class="data__btn">ADD TO CART</button>
                                        <Span class="data__price">From $9.98</Span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col l-3 m-0 c-0">
                            <div class="popular__list">
                                <img src="{{asset('frontend/assets/img/item1.jpg')}}" alt="" class="list__img">
                                <div class="list__data">
                                    <a href="#" class="data__category">Fish</a>
                                    <h3 class="data__name">
                                        Pizza Margherita
                                    </h3>
                                    <p class="data__desc">With basil, mozzarella, tomatoes</p>
                                    <div class="add-cart-btn">
                                        <button class="data__btn">ADD TO CART</button>
                                        <Span class="data__price">From $9.98</Span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- new menu  -->
            <div class="new" data-aos="fade-up">
                <div class="back-img"></div>
                <div class="overlay"></div>
                <div class="shape-top">
                    <img src="{{asset('frontend/assets/img/curve.png')}}" alt="">
                </div>
                <div class="new-detail">
                    <h2 class="popular__title new__title">whats new dishes</h2>
                    <h6 class="popular__desc new__desc">Clients’ Most Popular Choise</h6>
                    <div class="grid wide">
                        <div class="row">
                            @foreach ($products as $product)
                            <div class="col l-4 m-4 c-12">
                                <div class="popular__list">
                                    <img src="{{$product->product_image}}" alt="" class="list__img">
                                    <div class="newlist__data">
                                        <a href="#" class="data__category">{{$product->category->category_name}}</a>

                                        <h3 class="data__name">
                                            {{$product->product_name}}
                                        </h3>
                                        <p class="data__desc">With basil, mozzarella, tomatoes</p>
                                        <div class="add-cart-btn">
                                            <button class="data__btn addcart" data-id="{{$product->id}}" data-url="{{route('customer.add.cart',$product->id)}}">ADD TO CART</button>
                                            <Span class="data__price">From ${{$product->price}}</Span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="shape-bottom">
                    <img src="{{asset('frontend/assets/img/curve.png')}}" alt="">
                </div>
            </div>

            <!-- dish section starts  -->
            <section class="dish" id="dish" data-aos="fade-up">
                <div class="grid wide">
                    <div class="row">
                        <div class="col l-12">
                            <h2 class="dish__title"> popular dishes</h2>

                            <ul class="controls">
                                <li class="buttons button-active" data-filter="all">all</li>
                                <li class="buttons" data-filter="sushi">Sushi</li>
                                <li class="buttons" data-filter="pizza">Pizza</li>
                                <li class="buttons" data-filter="juice">Juice</li>
                                <li class="buttons" data-filter="pasta">Pasta</li>
                            </ul>

                            <div class="image-container">

                                <div class="image sushi">
                                    <img src="{{asset('frontend/assets/img/item1.jpg')}}" alt="">
                                    <a href="#">Sushi</a>
                                </div>
                                <div class="image sushi">
                                    <img src="{{asset('frontend/assets/img/item1.jpg')}}" alt="">
                                    <a href="#">Sushi</a>
                                </div>
                                <div class="image sushi">
                                    <img src="{{asset('frontend/assets/img/item1.jpg')}}" alt="">
                                    <a href="#">Sushi</a>
                                </div>

                                <div class="image pizza">
                                    <img src="{{asset('frontend/assets/img/item2.jpg')}}" alt="">
                                    <a href="#">Pizza</a>
                                </div>
                                <div class="image pizza">
                                    <img src="{{asset('frontend/assets/img/item2.jpg')}}" alt="">
                                    <a href="#">Pizza</a>
                                </div>
                                <div class="image pizza">
                                    <img src="{{asset('frontend/assets/img/item2.jpg')}}" alt="">
                                    <a href="#">Pizza</a>
                                </div>

                                <div class="image juice">
                                    <img src="{{asset('frontend/assets/img/juice1.jpg')}}" alt="">
                                    <a href="#">juice</a>
                                </div>
                                <div class="image juice">
                                    <img src="{{asset('frontend/assets/img/juice1.jpg')}}" alt="">
                                    <a href="#">juice</a>
                                </div>

                                <div class="image pasta">
                                    <img src="{{asset('frontend/assets/img/item3.jpg')}}" alt="">
                                    <a href="#">Pasta</a>
                                </div>

                                <a href="./menu.html" class="about__btn full-menu-btn">
                                    <span>View full menu</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- dish section ends -->
        </div>

@endsection
