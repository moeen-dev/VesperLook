<!doctype html>
<html>

<head>
    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="xOGFcx_rPPV9nFqHyRxNvVdccp-KWTFilwrjCCobSy0" />

    @include('frontend.partials.seo', ['seo' => $seo ?? null])

    {{-- Style links froneted/partilas/style-link.blade.php --}}
    @include('frontend.partials.style-link')

    @livewireStyles


</head>

<body id="home-version-1" class="home-version-1" data-style="default">

    <div class="site-content">

        <header id="header" class="header-area">
            <div class="top-bar">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="top-bar-left">
                                <p><i class="fas fa-phone"></i><a href="tel:{{ $genSetting->phone_number ?? '' }}">{{
                                        $genSetting->phone_number ?? 'Not Available' }}</a>
                                </p>

                                <p><i class="far fa-envelope"></i>
                                    <a href="mailto:{{ $genSetting->email ?? '' }}">{{ $genSetting->email ?? 'Not
                                        Available' }}</a>
                                </p>
                            </div>
                        </div>
                        <!-- Col -->
                        <div class="col-lg-6">
                            <div class="top-bar-right">
                                <div class="social">
                                    <ul>
                                        @if (!empty($genSetting) && $genSetting->facebook_url)
                                        <li><a href="{{ $genSetting->facebook_url }}"><i class="fab fa-facebook-f"
                                                    target="_blank"></i></a></li>
                                        @endif
                                        @if (!empty($genSetting) && $genSetting->pinterest_url)
                                        <li><a href="{{ $genSetting->pinterest_url }}"><i class="fab fa-pinterest-p"
                                                    target="_blank"></i></a></li>
                                        @endif
                                        @if (!empty($genSetting) && $genSetting->instagram_url)
                                        <li><a href="{{ $genSetting->instagram_url }}"><i class="fab fa-instagram"
                                                    target="_blank"></i></a></li>
                                        @endif
                                        @if (!empty($genSetting) && $genSetting->linkedin_url)
                                        <li><a href="{{ $genSetting->linkedin_url }}"><i class="fab fa-linkedin-in"
                                                    target="_blank"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                @if (Auth::guard('user')->check() && Auth::guard('user')->user()->is_admin == 0)
                                @if (Route::is('user.profile'))
                                <a href="{{ route('user.logout') }}" class="my-account">Sign Out</a>
                                @else
                                <a href="{{ route('user.profile') }}" class="my-account">My Account</a>
                                @endif
                                @else
                                <a href="{{ route('user.login') }}" class="my-account">Sign In</a>
                                @endif
                            </div>
                            <!--top-bar-right end-->
                        </div>
                        <!-- Col end-->
                    </div>
                    <!--Row end-->
                </div>
                <!--container end-->
            </div>
            <!--top-bar end-->

            <!-- Main Menu -->


            <div class="container-fluid custom-container menu-rel-container">
                <div class="row">
                    <!-- Logo
    ============================================= -->
                    <div class="col-lg-6 col-xl-3">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ url('assets/frontend/media/images/logo.png') }}" alt="Vesper Look">
                            </a>
                        </div>
                    </div>
                    <!--Col end-->

                    <!-- Main menu
    ============================================= -->

                    <div class="col-lg-12 col-xl-7 order-lg-3 order-xl-2 menu-container">
                        <div class="mainmenu style-two">
                            <ul id="navigation">

                                <li><a href="{{ route('home') }}"
                                        class="{{ Route::is('home') ? 'active' : '' }}">Home</a></li>
                                <li>
                                    <a href="{{ route('collection') }}"
                                        class="{{ Route::is('collection') || Route::is('collection.show') ? 'active' : '' }}">
                                        Collection
                                    </a>
                                </li>

                                <li class="has-child"><a style="cursor: pointer;">Category</a>
                                    <div class="mega-menu">
                                        @foreach ($navbarCategories as $category)
                                        <div class="mega-catagory per-25">
                                            <h4><a class="font-red">{{ $category->category_name }}</a></h4>
                                            <ul class="mega-button">
                                                @foreach ($category->subcategories as $subcategory)
                                                <li><a
                                                        href="{{ route('collection.show', ['categorySlug' => $category->slug, 'subcategorySlug' => $subcategory->slug]) }}">{{
                                                        $subcategory->subcategory_name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                </li>


                                <!-- Men's Category -->


                                <!-- Men's Category end -->

                                <li><a href="{{ route('shop') }}"
                                        class="{{ Route::is('shop') || Route::is('shop.details') ? 'active' : '' }}">Shop</a>
                                </li>
                                {{-- <li><a href="{{ route('blog') }}"
                                        class="{{ Route::is('blog') ? 'active' : ''}}">Blog</a></li> --}}
                                <li><a href="{{ route('contact') }}"
                                        class="{{ Route::is('contact') ? 'active' : '' }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--Menu container end-->


                    <div class="col-lg-6 col-xl-2 order-lg-2 order-xl-3">
                        <div class="header-right-menu">
                            <ul>
                                {{-- <li>
                                    <select class="custom-select">
                                        <option selected="">ENG</option>
                                        <option value="1">FRE</option>
                                        <option value="2">CHI</option>
                                    </select>
                                </li> --}}

                                <li class="top-search style-two"><a href="javascript:void(0)"><i
                                            class="fi fi-rs-search"></i></a>
                                    <input type="text" class="search-input" placeholder="Search">
                                </li>

                                @if (Auth::guard('user')->check() && Auth::guard('user')->user()->is_admin == 0)
                                @if (Route::is('user.profile'))
                                <li><a href="{{ route('user.logout') }}"><i class="fi fi-rs-user-logout"></i></a></li>
                                @else
                                <li><a href="{{ route('user.profile') }}"><i class="fi fi-rs-user"></i></a>
                                </li>
                                @endif
                                <li class="top-cart"><a href="{{ route('cart.index') }}"><i
                                            class="fi fi-rs-shopping-bag"></i><span>{{ $cart->count() }}</span></a>
                                </li>
                                @else
                                <li><a href="{{ route('user.login') }}"><i class="fi fi-rs-login"></i></a></li>
                                <li class="top-cart"><a href="{{ route('user.login', ['redirect' => 'cart']) }}"><i
                                            class="fi fi-rs-shopping-bag"></i><span>{{ $cart->count() }}</span></a>
                                </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <!--Col end-->
                </div>
                <!--Row end-->
            </div>
            <!--container end-->
        </header>
        <!--Header end-->


        <!--=========================-->
        <!--=        Mobile Header         =-->
        <!--=========================-->


        <header class="mobile-header">
            <div class="container-fluid custom-container">
                <div class="row">

                    <!-- Mobile menu Opener
     ============================================= -->
                    <div class="col-4">
                        <div class="accordion-wrapper">
                            <a href="#" class="mobile-open"><i class="flaticon-menu-1"></i></a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ url('assets/frontend/media/images/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="top-cart">
                            @if (Auth::guard('user')->check() && Auth::guard('user')->user()->is_admin == 0)
                            <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                ({{ $cart->count() }})</a>
                            @else
                            <a href="{{ route('user.login', ['redirect' => 'cart']) }}"><i class="fa fa-shopping-cart"
                                    aria-hidden="true"></i>
                                ({{ $cart->count() }})</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.row end -->
            </div>
            <!-- /.container end -->
        </header>

        <div class="accordion-wrapper">

            <!-- Mobile Menu Navigation
    ============================================= -->
            <div id="mobilemenu" class="accordion">
                <ul>
                    <li class="mob-logo"><a href="{{ route('home') }}">
                            <img src="{{ url('assets/frontend/media/images/logo.png') }}" alt="">
                        </a></li>
                    <li><a href="#" class="closeme"><i class="flaticon-close"></i></a></li>
                    <!-- Home menu -->
                    <li class="out-link"><a href="{{ route('home') }}">Home</a></li>
                    <!-- Collection menu -->
                    <li class="out-link"><a href="{{ route('collection') }}">Collections</a></li>

                    <li>
                        @foreach ($navbarCategories as $category)
                        <a class="link">{{ $category->category_name }}<i class="fa fa-chevron-down"></i></a>
                        <ul class="submenu">
                            @foreach ($category->subcategories as $subcategory)
                            <li><a
                                    href="{{ route('collection.show', ['categorySlug' => $category->slug, 'subcategorySlug' => $subcategory->slug]) }}">{{
                                    $subcategory->subcategory_name }}</a>
                            </li>
                            @endforeach
                        </ul>
                        @endforeach
                    </li>

                    <li class="out-link"><a href="{{ route('shop') }}">Shop</a></li>
                    {{-- <li class=" out-link"><a href="{{ route('blog') }}">Blog</a></li> --}}
                    <li class="out-link"><a href="{{ route('contact') }}">Contact</a></li>


                </ul>
                <div class="mobile-login">
                    @if (Auth::guard('user')->check() && Auth::guard('user')->user()->is_admin == 0)
                    <a href="{{ route('user.profile') }}">View Profile</a> |
                    <a href="{{ route('user.logout') }}">Sign Out</a>
                    @else
                    <a href="{{ route('user.login') }}">Sign In</a> |
                    <a href="{{ route('user.register') }}">Create Account</a>
                    @endif
                </div>
                <form action="#" id="moble-search">
                    <input placeholder="Search...." type="text">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        @yield('content')

        <!--=========================-->
        <!--=        Testimonial Area          =-->
        <!--=========================-->

        <section class="testimonial-area bg-one padding-120">
            <div class="container container-two">
                <div class="section-heading pb-30">
                    <h3>our happy <span>clients</span></h3>
                </div>
                <!-- /.section-heading-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="testimonial-carousel owl-carousel owl-theme">

                            <div class="single-testimonial">
                                <div class="tes-img">
                                    <img src="{{ url('assets/frontend/media/images/tes1.jpg') }}" alt="">
                                </div>
                                <div class="tes-content">
                                    <p>Autem vel eum iriure dolor in hendrerit ivulputate velit esse molestie consequat
                                        vel illum dolore eu olestie consequat feugiat nulla eros.</p>
                                    <span>emily watson</span>
                                </div>
                            </div>
                            <!-- /.single-testimonial -->

                            <div class="single-testimonial">
                                <div class="tes-img">
                                    <img src="{{ url('assets/frontend/media/images/tes2.png') }}" alt="">
                                </div>
                                <div class="tes-content">
                                    <p>Autem vel eum iriure dolor in hendrerit ivulputate velit esse molestie consequat
                                        vel illum dolore eu olestie consequat feugiat nulla eros.</p>
                                    <span>emily watson</span>
                                </div>
                            </div>
                            <!-- /.single-testimonial -->

                            <div class="single-testimonial">
                                <div class="tes-img">
                                    <img src="{{ url('assets/frontend/media/images/tes1.jpg') }}" alt="">
                                </div>
                                <div class="tes-content">
                                    <p>Autem vel eum iriure dolor in hendrerit ivulputate velit esse molestie consequat
                                        vel illum dolore eu olestie consequat feugiat nulla eros.</p>
                                    <span>emily watson</span>
                                </div>
                            </div>
                            <!-- /.single-testimonial -->

                            <div class="single-testimonial">
                                <div class="tes-img">
                                    <img src="{{ url('assets/frontend/media/images/tes2.png') }}" alt="">
                                </div>
                                <div class="tes-content">
                                    <p>Autem vel eum iriure dolor in hendrerit ivulputate velit esse molestie consequat
                                        vel illum dolore eu olestie consequat feugiat nulla eros.</p>
                                    <span>emily watson</span>
                                </div>
                            </div>
                            <!-- /.single-testimonial -->



                        </div>
                        <!-- /.testimonial-carousel -->
                    </div>
                    <!-- /.col-xl-12  -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.testimonial-area -->

        <!--=========================-->
        <!--=   Subscribe area      =-->
        <!--=========================-->

        <section class="subscribe-area style-two">
            <div class="container container-two">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="subscribe-text">
                            <h6>Join our newsletter</h6>
                        </div>
                    </div>
                    <!-- col-xl-6 -->

                    <div class="col-lg-7">
                        <div class="subscribe-wrapper">
                            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                                @csrf
                                <input placeholder="Enter Your Email" type="email" name="email" required>
                                <button type="submit">SUBSCRIBE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-two -->
        </section>
        <!-- subscribe-area -->

        <!--=========================-->
        <!--=   Footer area      =-->
        <!--=========================-->

        <footer class="footer-widget-area style-two">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <div class="footer-widget style-two">
                            <div class="logo">
                                <a href="#">
                                    <img src="{{ url('assets/frontend/media/images/logo.png') }}" alt="">
                                </a>
                            </div>
                            <p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel
                                illum dolore eu olestie.</p>
                        </div>
                    </div>
                    <!-- /.col-xl-3 -->
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-widget style-two">
                            <h3>Quick Links</h3>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Home</a>
                                    </li>
                                    <li><a href="{{ route('collection') }}"><i class="fas fa-chevron-right"></i>
                                            Collection</a></li>
                                    <li><a href="{{ route('shop') }}"><i class="fas fa-chevron-right"></i> Our
                                            Shop</a></li>
                                    <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i> Contact
                                            Us</a></li>
                                    <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> About
                                            Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-xl-3 -->
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-widget style-two">
                            <h3>CUSTOMER SERVICES</h3>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{ route('frontend.privacy') }}"><i class="fas fa-chevron-right"></i>
                                            Privacy Policy</a></li>
                                    <li><a href="{{ route('frontend.order.return') }}"><i
                                                class="fas fa-chevron-right"></i> Orders & Returns</a>
                                    </li>
                                    <li><a href="{{ route('frontend.payment.policy') }}"><i
                                                class="fas fa-chevron-right"></i> Payment Policy</a></li>
                                    <li><a href="#"><i class="fas fa-chevron-right"></i> Support Center</a></li>
                                    {{-- <li><a href="{{ route('frontend.faq') }}"><i class="fas fa-chevron-right"></i>
                                            FAQ's</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-xl-3 -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <div class="footer-widget style-two">
                            <div class="time-table">
                                <h3>OPENING TIME</h3>
                                <span>Monday - Friday ( 8.00 to 18.00 )</span>
                                <span>Saturday ( 8.00 to 18.00 )</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6 order-2 order-lg-1">
                            <p>Copyright © 2024<span> Vesper Look </span> • Developed by <a
                                    href="https://facebook.com/mdmoeenuddinn">Moeen Uddin</a></p>
                        </div>
                        <!-- /.col-xl-6 -->
                        <div class="col-md-12 col-lg-6 col-xl-6 order-1 order-lg-2">
                            <div class="footer-payment-icon">
                                <ul>
                                    <li><a href="#"><img src="{{ url('assets/frontend/media/images/p1.png') }}"
                                                alt=""></a></li>
                                    <li><a href="#"><img src="{{ url('assets/frontend/media/images/p2.png') }}"
                                                alt=""></a></li>
                                    <li><a href="#"><img src="{{ url('assets/frontend/media/images/p3.png') }}"
                                                alt=""></a></li>
                                    <li><a href="#"><img src="{{ url('assets/frontend/media/images/p4.png') }}"
                                                alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.col-xl-6 -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- container-fluid -->
        </footer>
        <!-- footer-widget-area -->

        <div class="backtotop">
            <i class="fa fa-angle-up backtotop_btn"></i>
        </div>

        <!-- Quick View -->

        <div class="modal quickview-wrapper">
            <div id="quickview-ajax-content">
                <!-- this section code on frontend/partials/quickview.blade.php -->
            </div>
        </div>

    </div>
    <!-- /#site -->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD4PSZD" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @livewireScripts

    <!-- Dependency Scripts -->
    @include('frontend.partials.scripts')

    <script>
        $('.form-image').dropify();

        window.toastMessages = {
            @if (Session::has('success'))
                success: "{{ Session::get('success') }}",
            @endif
            @if (Session::has('error'))
                error: "{{ Session::get('error') }}",
            @endif
            @if (Session::has('info'))
                info: "{{ Session::get('info') }}",
            @endif
            @if (Session::has('warning'))
                warning: "{{ Session::get('warning') }}",
            @endif
        };
    </script>

    @yield('scripts')


</body>

</html>