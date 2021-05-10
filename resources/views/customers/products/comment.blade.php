<div class="col l-12 m-12 c-12">
    {{-- <div class="cmt__heading">
        <h4>96 đánh giá</h4>
    </div> --}}
    <div class="cmt__box">
            @if (Auth::check())
        <img src="https://lh3.googleusercontent.com/a-/AOh14Gin9YErbXWxwOs0FJ9CDU4MCW5rLLAUbcBmBvaO=s400" alt="">
            <input class="effect-2" name="comment" type="text" placeholder="Placeholder Text" id="content0">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
            <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
            <div class="cmt__box-action">
                <div class="cmt__box-cancel">Hủy</div>
                <button id="button0" data-url="{{route('customer.product.commet')}}" onClick="submit(this)" class="cmt__box-ok">Bình luận</button>
            </div>
            @endif
    </div>
    {{-- @if ($comments->count('id') > 0)

    @endif --}}
    <div id="comments">
        {!! $comment_data !!}
    </div>
    <div class="cmt__more">
        Xem thêm đánh giá
    </div>
</div>
