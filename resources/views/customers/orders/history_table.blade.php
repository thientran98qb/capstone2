@extends('layouts.app')
@section('css')

<link rel="stylesheet" href="{{asset('frontend/assets/css/booktable.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css" integrity="sha384-jbCTJB16Q17718YM9U22iJkhuGbS0Gd2LjaWb4YJEZToOPmnKDjySVa323U+W7Fv" crossorigin="anonymous">
@endsection
@section('js')
    <script src="{{asset('js/reservation.js')}}"></script>
@endsection
@section('main')
<div class="grid">


    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="osahan-account-page-left shadow-sm bg-white h-100">
                    <div class="border-bottom p-4">
                        <div class="osahan-user text-center">
                            <div class="osahan-user-media" style="font-size: 19px">
                                <img class="mb-3 rounded-pill shadow-sm mt-1" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="gurdeep singh osahan">
                                <div class="osahan-user-media-body">
                                    <h6 class="mb-2">{{ $user->name }}</h6>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-9">
                <div class="osahan-account-page-right shadow-sm bg-white p-4 h-100">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane  fade  active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Past Orders</h4>
                            @foreach ($table_user as $item)
                            <div class="bg-white card mb-4 order-list shadow-sm">
                                <div class="gold-members p-4">
                                    <a href="#">
                                    </a>
                                    <div class="media">
                                        <div class="media-body" style="font-size: 18px">
                                            <a href="#">
                                                <span class="float-right text-info">Ordered on {{$item->pivot->date}} <i class="icofont-check-circled text-success"></i></span>
                                            </a>
                                            <h6 class="mb-2">
                                                <a href="#"></a>
                                                <a href="#" class="text-black">Order Table in the Restaurant</a>
                                            </h6>
                                            <p class="text-gray mb-1"><i class="icofont-location-arrow"></i> Name Table : {{$item->name}}({{$item->description}})
                                            </p>
                                            <p class="text-gray mb-3"><i class="icofont-list"></i> Time: {{$item->pivot->time}}
                                            <p class="text-dark">Quantity : {{$item->quantity}}(people)
                                            </p>
                                            <hr>

                                            <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold"> Status:</span> @if ($item->pivot->status == 2)
                                                <span class="badge badge-success">Successfully</span>
                                            @elseif($item->pivot->status== 0 )
                                                <span class="badge badge-danger">Waiting...</span>
                                            @endif
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
