<div id="slider">
    <div class="grid">
        @foreach ($slides as $slide)
            <div class="l-12 m-12 c-12">
                <div class="myslide fade" style="display: block;">
                    <div class="txt">
                        <h1>{{$slide->name}}</h1>
                        <div class="add-cart-btn slider__btn">
                            <button class="data__btn slider__btn-add">ADD TO CART</button>
                            <Span class="data__price slider__btn-price">From $9.98</Span>
                        </div>
                    </div>
                    <img src="{{$slide->image}}" style="width: 100%; height: 100%;">
                </div>
            </div>
        @endforeach
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <div class="dotsbox">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>

</div>
