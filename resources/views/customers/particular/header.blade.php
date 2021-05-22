<header id="header">
    <div class="grid wide">
        <div class="header__content">
            <a href="/" class="header__logo">
                <img src="{{asset('frontend/assets/img/main_logo_black.png')}}" alt="logo">
            </a>
            <ul class="header__nav">
                <li class="header__nav--item">
                    <a class="header__nav--link" href="{{route('run.py')}}">Home</a>
                </li>
                <li class="header__nav--item">
                    <a class="header__nav--link" href="{{ route('customer.menu.index')}}">Menu</a>
                </li>
                <li class="header__nav--item">
                    <a class="header__nav--link" href="{{ route('book.table') }}">Book a table</a>
                </li>
                <li class="header__nav--item">
                    <a class="header__nav--link" href="{{route('customer.about.index')}}">About</a>
                </li>
                <li class="header__nav--item">
                    <a class="header__nav--link" href="{{route('customer.contact.index')}}">Contract</a>
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
                <!-- search  -->
                <div class="search">
                    <form action="{{ route('customer.customer.search') }}" method="get">
                        @csrf
                        <input type="text" name="" class="search-txt search-txt-width" placeholder="Search..."/>
                        <button class="search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                </div>
                <!-- search  -->
                @include('customers.particular.cart')
                @if (auth()->user())
                <div class="user">
                    <ul class="header__nav">
                        <li class="header__nav--item">
                            <i class="icon-user fas fa-user"></i>{{auth()->user()->name}}
                            <ul class="header__subnav">
                                @if (Auth()->user()->checkRole('staff') == true)
                                <li class="header__subnav--item">
                                    <a href="/staff">Staff</a>
                                </li>
                                @endif
                                <li class="header__subnav--item">
                                    <a href="">Profile</a>
                                </li>
                                <li class="header__subnav--item">
                                    <a href="{{ route('past.order.table') }}">Order Table</a>
                                </li>
                                <li class="header__subnav--item">
                                    <a href="{{route('customer.history.order')}}">Orders</a>
                                </li>
                                <li class="header__subnav--item">
                                    <form action="{{route('logout')}}" method="POST">
                                        @csrf
                                        <button type="submit" style="cursor: pointer">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{-- <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit"><i class="icon-user fas fa-user"></i></button>
                    </form> --}}
                </div>
                @else
                <div class="user">
                    <a class="text-dark" style="font-size:14px;text-decoration: none;padding:0 10px; border-right:1px solid black;color:#333" href="/login">Login</a>
                    <a class="text-dark" style="font-size:14px;text-decoration: none;padding:0 10px;color:#333" href="/register">Register</a>
                </div>
                @endif

            </div>

        </div>
    </div>
</header>
