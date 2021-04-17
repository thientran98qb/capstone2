<footer id="footer" data-aos="fade-up">
    <div class="shape-top">
        <img src="{{asset('frontend/assets/img/curve.png')}}" alt="">
    </div>
    <div class="grid wide">
        <div class="row">
            <div class="col l-12 m-12 c-12">
                <div class="footer__title">
                    <a href="/" class="footer__logo">
                        <img src="{{asset('frontend/assets/img/logo.png')}}" alt="logo">
                    </a>
                    <div class="footer__social">
                        @foreach ($socials as $social)
                        <a href="{{ $social->config_value}}" target="_blank"><i class="{{ $social->config_key}}"></i></a>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col l-4 m-12 c-12">
                <div class="footer__contact">
                    <h6>contact us</h6>
                </div>
                <ul>
                    @foreach ($contacts as $contact)
                    <li class="contact__list">
                        <div class="name">{{$contact->config_key}} :</div>
                        <div class="dots"></div>
                        <span>{{$contact->config_value}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col l-4 m-12 c-12">
                <div class="footer__time">
                    <h6>OPENING TIME</h6>
                </div>
                <ul>
                    <li class="time__list">
                        <div class="name">Friday to Sunday</div>
                        <div class="dots"></div>
                        <span>09:00 - 22:00</span>
                    </li>
                    <li class="time__list">
                        <div class="name">Tuesday to thursday</div>
                        <div class="dots"></div>
                        <span>11:00 - 19:00</span>
                    </li>
                    <li class="time__list">
                        <div class="name">Monday</div>
                        <div class="dots"></div>
                        <span>Closed</span>
                    </li>
                </ul>
            </div>
            <div class="col l-4 m-12 c-12">
                <div class="footer__subscribe">
                    <h6>SUBSCRIBE</h6>
                </div>
                <p >Want to be notified when we launch a new template or an udpate. Just sign up and well
                    send you a notification by email.</p>
                <form action="">
                    <div class="form__left">
                        <input type="email" name="subscribe" placeholder="Your Email">
                    </div>
                    <div class="form__right">
                        <!-- <button class="">
                            <span>Send</span>
                            <i></i>
                        </button> -->
                        <button class="btn-skew form__btn">
                            <span>Send</span>
                            <i></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="ftail">
        <div class="grid wide">
            <div class="row">
                <div class="col l-12 m-12 c-12">
                    <span>© 2021, Made by <b> Duy Tan university team.</b></span>
                </div>
            </div>
        </div>
    </div>
</footer>
