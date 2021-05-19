@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/about.css')}}">
@endsection
@section('main')
<div id="main">
    <!--about section start-->
     <!-- about us  -->
     <div class="about " data-aos="fade-up">
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
    <!--about section end-->
</div>
@endsection
