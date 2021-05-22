<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

        body {
            font-size: 18px;
            font-family: 'Calibri', sans-serif !important
        }

        .mt-100 {
            margin-top: 50px
        }

        .mb-100 {
            margin-bottom: 50px
        }

        .card {
            border-radius: 1px !important
        }

        .card-header {
            background-color: #fff
        }

        .card-header:first-child {
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0
        }

        .btn-sm,
        .btn-group-sm>.btn {
            padding: .25rem .5rem;
            font-size: 16px;
            line-height: 1.5;
            border-radius: .2rem
        }
    </style>
    <title>Document</title>
</head>
<body>

    <div class="container-fluid mt-100 mb-100">
        <div id="ui-view">
            <div>
                <div class="card">
                    <div class="card-header"> Invoice<strong>#BBB-245432</strong>
                        <div class="pull-right"> <a class="btn btn-sm btn-info" href="{{route('bill.pdf')}}" data-abc="true"><i class="fa fa-print mr-1"></i> Print</a> <a class="btn btn-sm btn-info" href="#" data-abc="true"><i class="fa fa-file-text-o mr-1"></i> Save</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <h6 class="mb-3">From:</h6>
                                <div><strong>BBBootstrap Inc.</strong></div>
                                <div>546 Aston Avenue</div>
                                <div>NYC, NY 12394</div>
                                <div>Email: contact@bbbootstrap.com</div>
                                <div>Phone: +1 848 389 9289</div>
                            </div>

                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th class="right">COST</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills->products as $key => $bill)
                                    <tr>
                                        <td class="center">{{$key+1}}</td>
                                        <td class="left">{{ $bill->product_name }}</td>
                                        <td>{{$bill->pivot->amount}}</td>
                                        <td class="right">{{number_format($bill->price)}} VND</td>
                                        <td class="right">{{number_format($bill->pivot->total)}} VND</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-5"></div>
                            <div class="col-lg-6 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left"><strong>Subtotal</strong></td>
                                            @php
                                                $total=0;
                                                foreach($bills->products as $product){
                                                    $total+= $product->pivot->total;
                                                }
                                            @endphp
                                            <td class="right">{{number_format($total)}} VND</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Discount</strong></td>
                                            <td class="right">0 VND</td>
                                        </tr>

                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="right"><strong>{{number_format($total)}} VND</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="pull-right">
                                    {{--  <a class="btn btn-sm btn-success" href="#" data-abc="true"><i class="fa fa-paper-plane mr-1"></i> Proceed to payment
                                    </a>  --}}
                                    <form action="{{route('bill.save')}}" method="get">
                                        @csrf
                                        <input type="hidden" name="total_bill" value="{{$total}}">
                                        <input type="submit" class="btn btn-sm btn-success" value="Proceed to payment">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
