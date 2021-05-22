<div class="cart">
    <i class="icon-cart fas fa-shopping-cart"></i>
    <span class="cart-notice">
      @if (session()->has('cart'))
        @php
            echo count(session()->get('cart'))
        @endphp
      @else
      0
      @endif
    </span>
    <!-- No cart: cart-list-empty -->
    <div class="cart-list ">
        <img src="{{asset('frontend/assets/img/cartempty.png')}}" alt="" class="cart-list-img">
        <!-- Has cart  -->
        <h4 class="cart-heading">
            Your Cart
        </h4>
        <ul class="cart-list-item">
           @if (session()->has('cart'))
           @foreach (session()->get('cart') as $item)
            <li class="cart-item">
                <img src="{{$item['img']}}" alt="" class="cart-item-img">
                <div class="cart-info">
                    <div class="cart-info-text">
                        <h5 class="cart-info-name">{{$item['product_name']}}</h5>
                        <input type="number"class="cart-info-quantily quantity" style="width: 50px" value="{{$item['quantity']}}" data-idd="{{$item['id']}}" data-urlItem="{{ route('customer.change.item.cart',$item['id']) }}" min="1">
                        <span class="cart-info-x">x</span>
                        <span class="cart-info-price"> {{number_format($item['price'])}} VND</span>
                        <span style="border-left: 1px solid black;padding:0 0 0 10px" class="cart-info-price totalPrice_{{$item['id']}}">{{number_format($item['total_price'])}} VND</span>
                    </div>
                    <div class="cart-info-remove">
                        <span class="remove-item-cart" data-idremove="{{$item['id']}}"><i class="fas fa-times"></i></span>
                    </div>
                </div>
            </li>
            @endforeach
           @else
            <p class="text-center">Cart is empty</p>
           @endif
        </ul>
        <div id="thu">
            @if (session()->has('cart') && !empty(session()->get('cart')))
        <a href="{{route('customer.checkout')}}" class="cart-btn">
            <span>Checkout</span>
        </a>
        @endif
        </div>
    </div>
</div>
