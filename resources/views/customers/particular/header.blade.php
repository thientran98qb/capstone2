<header id="header">
    <div class="grid wide">
        <div class="header__content">
            <a href="/" class="header__logo">
                <img src="{{asset('frontend/assets/img/main_logo_black.png')}}" alt="logo">
            </a>
            <ul class="header__nav">
                <li class="header__nav--item">
                    <a class="header__nav--link" href="/">Home</a>
                </li>
                <li class="header__nav--item">
                    <a class="header__nav--link" href="{{ route('customer.menu.index')}}">Menu</a>
                </li>
                <li class="header__nav--item">
                    <a class="header__nav--link" href="{{ route('book.table') }}">Book a table</a>
                </li>
                <li class="header__nav--item">
                    <a class="header__nav--link" href="#main">About</a>
                </li>
                <li class="header__nav--item">
                    <a class="header__nav--link" href="#footer">Contract</a>
                </li>
            </ul>

            <label for="nav-mobie-input" class="nav__bar--btn">
                <i class="fas fa-bars"></i>
            </label>

            <input type="checkbox" hidden name="" class="nav-input" id="nav-mobie-input">

            <label for="nav-mobie-input" class="nav__overlay"></label>

            <div class="header__nav--mobie">
                <label for="nav-mobie-input"  class="nav__mobie-close">
                    <i class="fas fa-times"></i>
                </label>
                <img class="nav__logo--mobie" src="{{asset('frontend/assets/img/main_logo_black.png')}}" alt="logo">
                <ul class="nav--mobie">
                    <li class="nav--item-mobie">
                        <i class=" fas fa-home"></i>
                        <a class="nav--link-mobie" href="./index.html">Home</a>
                    </li>
                    <li class="nav--item-mobie">
                        <i class=" fab fa-elementor"></i>
                        <a class="nav--link-mobie" href="./menu.html">Menu</a>
                    </li>
                    <li class="nav--item-mobie">
                        <i class=" fas fa-receipt"></i>
                        <a class="nav--link-mobie" href="#book a table">Book a table</a>
                    </li>
                    <li class="nav--item-mobie">
                        <i class=" fas fa-users"></i>
                        <a class="nav--link-mobie" href="#">Login</a>
                    </li>
                    <li class="nav--item-mobie">
                        <i class=" fas fa-address-book"></i>
                        <a class="nav--link-mobie" href="#footer">Contract</a>
                    </li>
                </ul>
            </div>

            <div class="header__icon">
                @include('customers.particular.cart')
                <div class="user">
                    <i class="icon-user fas fa-user"></i>
                </div>
            </div>

        </div>
    </div>
</header>
