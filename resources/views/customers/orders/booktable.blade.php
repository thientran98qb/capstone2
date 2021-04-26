@extends('layouts.app')
@section('css')

<link rel="stylesheet" href="{{asset('frontend/assets/css/booktable.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@endsection
@section('js')
    <script src="{{asset('js/reservation.js')}}"></script>
@endsection
@section('main')
<div class="grid">
    <div class="row">
        <div class="col l-12 m-12 c-12">
           @if (!$check)
           <section class = "banner book-table">
            <h2 data-aos="fade-down">BOOK YOUR TABLE NOW</h2>
            <div class = "card-container">
                <div class = "card-img" data-aos="fade-right">
                   <img src="{{asset('frontend/assets/img/card-img.jpg')}}" alt="">
                </div>

                <div class = "card-content" data-aos="fade-left">
                    <h3>Reservation</h3>
                    <form action="{{route('reservation.table')}}" method="post" style="margin-left: 25px;">
                        @csrf
                        <div class="row">
                            <div class = "form-row col">
                                <input type="date" class="form-input col-sm-4" name="date" placeholder="Select date for booking" required>
                                <input type="time" class="form-input col-sm-6" name="time" placeholder="Select time for booking" required>
                            </div>
                        </div>
                        <div class = "form-row row">
                            <select class="form-select col-sm-4" name = "quantity" id="selectQuantity" data-url="{{route('filter.table')}}">
                                <option value = "hour-select">Select quantity</option>
                                <option value = "2">2</option>
                                <option value = "4">4</option>
                                <option value = "6">6</option>
                                <option value = "8">8</option>
                            </select>
                            <select class="form-select col-sm-6" name = "table" id="opt_table">
                                <option value = "hour-select">Select table</option>

                            </select>
                        </div>
                        <div class = "form-row row">
                            <input class="form-input col-sm-4" type = "text" value="{{$user->name}}" name="fullname" placeholder="Full Name">
                            <input class="form-input col-sm-6" type = "text" placeholder="Phone Number" name="phone_number">
                        </div>

                        <div class = "form-row">
                            {{-- <input class="form-input" type = "number" placeholder="How Many Persons?" min = "1" max="10"> --}}
                            <input class="form-input" type ="submit" value = "BOOK TABLE">
                        </div>
                    </form>
                </div>
            </div>
        </section>
           @else
           <section class = "banner book-table">
             <div class="card" style="width: 50%;font-size:20px">
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        You reservation successfully !
                      </div>
                      <div class="card mb-3">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 text-secondary">Full Name</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                             {{$user->name}}
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 text-secondary">Phone</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              {{$table->pivot->phone_number}}
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 text-secondary">Date</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$table->pivot->date}}
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 text-secondary">Time</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$table->pivot->time}}
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 text-secondary">Table</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$table->name}}
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 text-secondary">Capacity</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$table->quantity}}
                            </div>
                          </div>
                        </div>
             </div>
           </section>
           @endif
        </div>
    </div>
</div>

@endsection
