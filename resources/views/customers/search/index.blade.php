<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/search.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
          <!-- BEGIN SEARCH RESULT -->
          <div class="col-md-12">
            <div class="grid search">
              <div class="grid-body">
                <div class="row">
                  <div class="col-md-12">
                      <a href="/">Back to Home</a>
                    <h2><i class="fa fa-file-o"></i> Result</h2>
                    <hr>
                    <!-- BEGIN SEARCH INPUT -->
                    <div class="input-group">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->

                <!-- SEARCH FORM -->
                <form class="form-inline" method="get" action="{{ route('customer.search') }}">
                    <div class="form-group mx-sm-2 mb-2">
                        <label class="sr-only"> Nhập tên sản phẩm </label>
                        <input type="text"
                            value="{{ request()->name }}"
                            class="form-control" placeholder="Nhập tên sản phẩm" name="name">
                    </div>

                    <div class="form-group mx-sm-2 mb-2">
                        <label class="sr-only"> Nhập tags sản phẩm </label>
                        <input type="text"
                            value="{{ request()->tags }}"
                            class="form-control" placeholder="Nhập tags sản phẩm" name="tags">
                    </div>

                    <div class="form-group mx-sm-2 mb-2">
                        <label class="sr-only"> Nhập tên sản phẩm </label>
                        <select class="form-control" name="category_id">
                            <option value="">Chọn danh mục sản phẩm</option>
                            {!! $htmlOptionSearchHeader !!}
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                </form>
            </nav>
            <!-- /.navbar -->

                    </div>
                    <!-- END SEARCH INPUT -->
                    <p>Showing all results matching "web development"</p>

                    <div class="padding"></div>

                    <div class="row">
                      <!-- BEGIN ORDER RESULT -->
                      <div class="col-sm-6">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Order by <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li ><a href="{{ request()->fullUrlWithQuery(['case'=>'name']) }}" class="dropdown-item">Name</a></li>
                            <li ><a href="{{ request()->fullUrlWithQuery(['case'=>'rate']) }}" class="dropdown-item">Rating</a></li>
                          </ul>
                        </div>
                      </div>
                      <!-- END ORDER RESULT -->

                      <div class="col-md-6 text-right">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default active"><i class="fa fa-list"></i></button>
                          <button type="button" class="btn btn-default"><i class="fa fa-th"></i></button>
                        </div>
                      </div>
                    </div>

                    <!-- BEGIN TABLE RESULT -->
                    <div class="table-responsive">
                      @if (count($products)>0)
                      <table class="table table-hover">
                        <tbody>
                      @foreach ($products as $key=>$product)
                      <tr>
                        <td class="number text-center">{{$key+1}}</td>
                        <td class="image"><a href="{{ route('customer.product.index',$product->id) }}"><img src="{{$product->product_image}}" alt=""></a></td>
                        <td class="product"><strong>{{$product->product_name}}</strong><br></td>
                        {{-- {{$product->category->category_name}} --}}
                        <td >
                            <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-show-caption="false" data-step="0.1" value="{{ $product->averageRating }}" data-size="xs" disabled="">
                        </td>
                        <td class="price text-right">${{$product->price}}</td>
                      </tr>
                      @endforeach
                      </tbody></table>
                      @else
                          <p>No record</p>
                      @endif
                    </div>
                    <!-- END TABLE RESULT -->

                    <!-- BEGIN PAGINATION -->
                   {{$products->links()}}
                  </div>
                  <!-- END RESULT -->
                </div>
              </div>
            </div>
          </div>
          <!-- END SEARCH RESULT -->
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
    </body>
</html>

