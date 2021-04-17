@extends('layouts.app')
@section('css')

<link rel="stylesheet" href="{{asset('frontend/assets/css/booktable.css')}}">
@endsection
@section('main')
<div class="grid">
    <div class="row">
        <div class="col l-12 m-12 c-12">
            <section class = "banner book-table">
                <h2 data-aos="fade-down">BOOK YOUR TABLE NOW</h2>
                <div class = "card-container">
                    <div class = "card-img" data-aos="fade-right">
                       <img src="{{asset('frontend/assets/img/card-img.jpg')}}" alt="">
                    </div>

                    <div class = "card-content" data-aos="fade-left">
                        <h3>Reservation</h3>
                        <form>
                            <div class = "form-row">
                                <select class="form-select" name = "days">
                                    <option value = "day-select">Select Day</option>
                                    <option value = "sunday">Sunday</option>
                                    <option value = "monday">Monday</option>
                                    <option value = "tuesday">Tuesday</option>
                                    <option value = "wednesday">Wednesday</option>
                                    <option value = "thursday">Thursday</option>
                                    <option value = "friday">Friday</option>
                                    <option value = "saturday">Saturday</option>
                                </select>

                                <select class="form-select" name = "hours">
                                    <option value = "hour-select">Select Hour</option>
                                    <option value = "10">10: 00</option>
                                    <option value = "10">12: 00</option>
                                    <option value = "10">14: 00</option>
                                    <option value = "10">16: 00</option>
                                    <option value = "10">18: 00</option>
                                    <option value = "10">20: 00</option>
                                    <option value = "10">22: 00</option>
                                </select>
                            </div>

                            <div class = "form-row">
                                <input class="form-input" type = "text" placeholder="Full Name">
                                <input class="form-input" type = "text" placeholder="Phone Number">
                            </div>

                            <div class = "form-row">
                                <input class="form-input" type = "number" placeholder="How Many Persons?" min = "1" max="10">
                                <input class="form-input" type = "submit" value = "BOOK TABLE">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
