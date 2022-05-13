<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="" />
    <title>@yield('title', __('main.online_shop'))</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.ico')}}" />

    <!--**********************************
        all css files
    *************************************-->

    <!--***************************************************php artisan cache:clear
       fontawesome,bootstrap,plugins and main style css
     ***************************************************-->

    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    @stack('css')

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->

    <!--****************************
         Minified  css
    ****************************-->

    <!--***********************************************
       vendor min css,plugins min css,style min css
     ***********************************************-->

    <!-- <link rel="stylesheet" href="assets/css/vendor/vendor.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/style.min.css" /> -->

</head>

<body>

<!-- offcanvas-overlay start -->
<div class="offcanvas-overlay"></div>
<!-- offcanvas-overlay end -->

<!-- offcanvas-mobile-menu start -->
<div id="offcanvas-mobile-menu" class="offcanvas theme1 offcanvas-mobile-menu">
    <div class="inner">
        <div class="border-bottom mb-4 pb-4 text-end">
            <button class="offcanvas-close">×</button>
        </div>
        <div class="offcanvas-head mb-4">
            <nav class="offcanvas-top-nav">
                <ul class="d-flex justify-content-center align-items-center">
                    <li class="mx-3"><a href="compare.html"><i class="ion-ios-loop-strong"></i> Compare <span>(0)</span>
                        </a></li>
                    <li class="mx-3">
                        <a href="wishlist.html"> <i class="ion-android-favorite-outline"></i> Wishlist
                            <span>(0)</span></a>
                    </li>
                </ul>
            </nav>
        </div>
        <nav class="offcanvas-menu">
            <ul>
                <li>
                    <a href="{{ route('categories') }}"><span class="menu-text">@lang('main.categories')</span></a>
                        <ul class="offcanvas-submenu">
                            @foreach($categories as $category)
                                <li><a href="{{ route('category',[$category->code]) }}">{{ $category->__('name') }}</a></li>
                            @endforeach
                            <li>
                                <a href="#" class="ps-0">{{ session('locale') }} <i class="ion-ios-arrow-down"></i></a>
                                <ul class="sub-menu">
                                    @foreach(config('app.locales') as $key => $name)
                                        <li><a href="{{ route('locale',$key) }}" {{ $key == session('locale') ? 'disabled' : '' }}>{{ $key }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="ps-0">{{ $currencySymbol }} <i class="ion-ios-arrow-down"></i></a>
                                <ul class="sub-menu">
                                    @foreach($currencies as $currency)
                                        <li><a href="{{ route('currency',$currency['code']) }}">{{ $currency['symbol'] }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- offcanvas-mobile-menu end -->

<!-- OffCanvas Wishlist Start -->
<div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist theme1">
    <div class="inner">
        <div class="head d-flex flex-wrap justify-content-between">
            <span class="title">Wishlist</span>
            <button class="offcanvas-close">×</button>
        </div>
        <ul class="minicart-product-list">
            <li>
                <a href="single-product.html" class="image"><img src="{{asset('img/product/4.jpg')}}"
                                                                 alt="Cart product Image"></a>
                <div class="content">
                    <a href="single-product.html" class="title">Walnut Cutting Board</a>
                    <span class="quantity-price">1 x <span class="amount">$100.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"><img src="{{asset('img/product/5.jpg')}}"
                                                                 alt="Cart product Image"></a>
                <div class="content">
                    <a href="single-product.html" class="title">Lucky Wooden Elephant</a>
                    <span class="quantity-price">1 x <span class="amount">$35.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"><img src="{{asset('img/product/6.jpg')}}"
                                                                 alt="Cart product Image"></a>
                <div class="content">
                    <a href="single-product.html" class="title">Fish Cut Out Set</a>
                    <span class="quantity-price">1 x <span class="amount">$9.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
        </ul>
        <a href="wishlist.html" class="btn theme--btn1 btn--lg text-uppercase  d-block d-sm-inline-block mt-30">view
            wishlist</a>
    </div>
</div>
<!-- OffCanvas Wishlist End -->

<!-- OffCanvas Cart Start -->
<div id="offcanvas-cart" class="offcanvas offcanvas-cart theme1">
    <div class="inner">
        <div class="head d-flex flex-wrap justify-content-between">
            <span class="title">Cart</span>
            <button class="offcanvas-close">×</button>
        </div>
        <ul class="minicart-product-list">
            <li>
                <a href="single-product.html" class="image"><img src="{{asset('img/product/1.jpg')}}"
                                                                 alt="Cart product Image"></a>
                <div class="content">
                    <a href="single-product.html" class="title">Walnut Cutting Board</a>
                    <span class="quantity-price">1 x <span class="amount">$100.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"><img src="{{asset('img/product/2.jpg')}}"
                                                                 alt="Cart product Image"></a>
                <div class="content">
                    <a href="single-product.html" class="title">Lucky Wooden Elephant</a>
                    <span class="quantity-price">1 x <span class="amount">$35.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"><img src="{{asset('img/product/3.jpg')}}"
                                                                 alt="Cart product Image"></a>
                <div class="content">
                    <a href="single-product.html" class="title">Fish Cut Out Set</a>
                    <span class="quantity-price">1 x <span class="amount">$9.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
        </ul>
        <div class="sub-total d-flex flex-wrap justify-content-between">
            <strong>Subtotal :</strong>
            <span class="amount">$144.00</span>
        </div>
        <a href="cart.html" class="btn theme--btn1 btn--lg text-uppercase  d-block d-sm-inline-block me-sm-2">view
            cart</a>
        <a href="checkout.html"
           class="btn theme--btn1 btn--lg text-uppercase  d-block d-sm-inline-block mt-4 mt-sm-0">checkout</a>
        <p class="minicart-message">Free Shipping on All Orders Over $100!</p>
    </div>
</div>
<!-- OffCanvas Cart End -->

<!-- offcanvas-setting Start -->
<div id="offcanvas-setting" class="offcanvas offcanvas-cart theme1">
    <div class="inner">
        <div class="head d-flex justify-content-between">
            <span class="title">@lang('main.menu_settings')</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="content_setting">
            <div class="info_setting">
                <h3 class="title_setting">@lang('main.my_account')</h3>
                <ul>
                    @guest
                        <li><a href="{{ route('login') }}">@lang('main.sign_in')</a></li>
                        <li><a href="{{ route('register') }}">@lang('main.register')</a></li>
                    @endguest
                    @auth
                        @ifAdmin
                            <li><a href="{{ route('home') }}">@lang('main.admin_panel')</a></li>
                        @else
                            <li><a href="{{ route('person.orders.index') }}">@lang('main.my_orders')</a></li>
                        @endifAdmin
                        <li><a href="{{ route('get-logout') }}">@lang('main.logout')</a></li>
                    @endauth
                </ul>
            </div>

            <div class="info_setting">
                <h3 class="title_setting">@lang('main.languages')</h3>
                <ul>

                    @foreach(config('app.locales') as $key => $name)
                        <li {{ $key == session('locale') ? 'class=active' : '' }}>
                            <a href="{{ route('locale',$key) }}" {{ $key == session('locale') ? 'disabled' : '' }}>{{ $key }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="info_setting">
                <div class="title_setting">@lang('main.currency') :</div>
                <ul>
                    @foreach($currencies as $currency)
                        <li {{ $currency['symbol'] == $currencySymbol ? 'class=active' : '' }}>
                            <a href="{{ route('currency',$currency['code']) }}" {{ $currency['code'] == $currencySymbol ? 'disabled' : '' }}>{{$currency['code']}} {{ $currency['symbol'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!--offcanvas-setting End -->

<!-- header start -->
<header id="sticky" class="header style2 theme1">
    <!-- header-middle satrt -->
    <div class="header-middle px-xl-4">
        <div class="container-fluid position-relative">
            <div class="row align-items-center">
                <div class="col-9 col-xl-7 position-xl-relative">
                    <div class="d-flex align-items-center justify-content-lg-between">
                        <nav class="header-bottom theme1 d-none d-lg-block">
                            <ul class="main-menu d-flex align-items-center">
                                <li>
                                    <a href="#" class="ps-0">@lang('main.categories') <i class="ion-ios-arrow-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach($categories as $category)
                                            <li><a href="{{ route('category',[$category->code]) }}">{{ $category->__('name') }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="logo me-lg-5 me-xl-0">
                            <a href="{{ route('index') }}"><img src="{{ asset('img/logo/logo-dark.jpg') }}" alt="logo"></a>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-xl-5">
                    <!-- search-form end -->
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="cart-block-links theme1">
                            <ul class="d-flex align-items-center">
                                <li>
                                    <a href="javascript:void(0)" class="search search-toggle">
                                        <i class="ion-ios-search-strong"></i>
                                    </a>
                                </li>
                                <li class="position-relative d-none d-sm-block">
                                    <a class="offcanvas-toggle" href="#offcanvas-wishlist">
                                        <i class="ion-android-favorite-outline"></i>
                                        <span class="badge cbdg1">4</span>
                                    </a>
                                </li>
                                <li class="cart-block position-relative d-none d-sm-block">
                                    <a class="offcanvas-toggle" href="#offcanvas-cart">
                                        <i class="ion-bag"></i>
                                        <span class="badge cbdg1">{{ $quantityInBasket }}</span>
                                    </a>
                                </li>
                                <li class="me-0 cart-block">
                                    <a class="offcanvas-toggle" href="#offcanvas-setting">
                                        <i class="ion-android-settings"></i>
                                    </a>
                                </li>
                                <!-- cart block end -->
                            </ul>
                        </div>
                        <div class="mobile-menu-toggle theme1 d-lg-none">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewbox="0 0 800 600">
                                    <path
                                            d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                            id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path
                                            d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                            id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318)">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-middle end -->
</header>
<!-- header end -->
@yield('content')
<!-- footer strat -->
<footer class="bg-lighten2 theme1 position-relative">
    <!-- footer bottom start -->
    <div class="footer-bottom pt-70 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-logo mb-30">
                            <a href="index.html">
                                <img src="{{ asset('img/logo/logo-dark.jpg') }}" alt="footer logo">
                            </a>
                        </div>
                        <p class="text mb-35">We are a team of designers and developers that create high quality
                            Magento, Prestashop, Opencart.</p>
                        <div class="social-network">
                            <h2 class="title text mb-20 text-capitalize">Follow Us On Social:</h2>
                            <ul class="d-flex">
                                <li><a href="https://www.facebook.com/" target="_blank"><span
                                                class="ion-social-facebook"></span></a></li>
                                <li><a href="https://twitter.com/" target="_blank"><span
                                                class="ion-social-twitter"></span></a></li>
                                <li><a href="https://www.youtube.com/" target="_blank"><span
                                                class="ion-social-youtube-outline"></span></a></li>
                                <li><a href="https://www.youtube.com/" target="_blank"><span
                                                class="ion-social-googleplus"></span></a></li>
                                <li class="me-0"><a href="https://www.instagram.com/" target="_blank"><span
                                                class="ion-social-instagram-outline"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2 mb-30">
                    <div class="footer-widget">
                        <div class="section-title mb-20">
                            <h2 class="title text-dark text-capitalize">My Account</h2>
                        </div>
                        <address class="mb-0">
                            <span>Saturday - Thurs: 9AM - 6PM</span>
                            <span>Sat: 9AM-6PM</span>
                            <span>Friday Closed</span>
                            <span>We Work All The Holidays</span>
                        </address>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2 mb-30">
                    <div class="footer-widget">
                        <div class="section-title mb-20">
                            <h2 class="title text-dark text-capitalize">Opening Time</h2>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="#">Delivery</a></li>
                            <li><a href="about-us.html">About us</a></li>
                            <li><a href="#">Secure payment</a></li>
                            <li><a href="contact.html">Contact us</a></li>
                            <li><a href="#">Sitemap</a></li>
                            <li><a href="#">Stores</a></li>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2 mb-30">
                    <div class="footer-widget">
                        <div class="section-title mb-20">
                            <h2 class="title text-dark text-capitalize">Information</h2>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="#">Legal Notice</a></li>
                            <li><a href="#">Prices drop</a></li>

                            <li><a href="#">New products</a></li>

                            <li><a href="#">Best sales</a></li>

                            <li><a href="login.html">Login</a></li>

                            <li><a href="myaccount.html">My account</a></li>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom end -->
    <!-- coppy-right start -->
    <div class="coppy-right">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="border-top py-20">
                        <div class="row">
                            <div class="col-12 col-md-5 col-lg-4 col-xl-3 order-last order-md-first">
                                <div class="text-center text-lg-start">
                                    <p class="mb-3 mb-md-0">Copyright &copy; <a
                                                href="https://hasthemes.com/">HasThemes</a>. All
                                        Rights Reserved</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-7 col-lg-8 col-xl-9">
                                <ul
                                        class="footer-menu copyright-menu d-flex flex-wrap justify-content-center justify-content-md-end">
                                    <li><a href="#">Legal Notice</a></li>
                                    <li><a href="#">Prices drop</a></li>

                                    <li><a href="#">New products</a></li>

                                    <li><a href="#">Best sales</a></li>

                                    <li><a href="login.html">Login</a></li>

                                    <li><a href="myaccount.html">My account</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- coppy-right end -->
</footer>
<!-- footer end -->

<!-- search-box and overlay start -->
<div class="overlay">
    <div class="scale"></div>
    <form class="search-box" action="#">
        <input type="text" name="search" placeholder="Search products..." />
        <button id="close" type="submit"><i class="ion-ios-search-strong"></i></button>
    </form>
    <button class="btn-close"><i class="ion-android-close"></i></button>
</div>
<!-- search-box and overlay end -->

<!-- modals start -->

<!-- first modal -->
<div class="modal fade theme1 style1" id="quick-view" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6 mb-5 mb-lg-0">
                        <div class="product-sync-init mb-20">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="{{ asset('img/slider/thumb/1.jpg') }}" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="{{ asset('img/slider/thumb/2.jpg') }}" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="{{ asset('img/slider/thumb/3.jpg') }}" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="{{ asset('img/slider/thumb/4.jpg') }}" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                        </div>

                        <div class="product-sync-nav slick-nav-sync">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"> <img src="{{ asset('img/slider/thumb/1.1.jpg') }}"
                                                                       alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"> <img src="{{ asset('img/slider/thumb/2.1.jpg') }}"
                                                                       alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="{{ asset('img/slider/thumb/3.1.jpg') }}"
                                                                      alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="{{ asset('img/slider/thumb/4.1.jpg') }}"
                                                                      alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="{{ asset('img/slider/thumb/2.1.jpg') }}"
                                                                      alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mt-5 mt-md-0">
                        <div class="modal-product-info">
                            <div class="product-head">
                                <h2 class="title">Brixton Patrol All Terrain Anorak Jacket</h2>
                                <h4 class="sub-title">Reference: demo_5</h4>
                                <div class="star-content mb-20">
                                    <span class="star-on"><i class="ion-ios-star"></i> </span>
                                    <span class="star-on"><i class="ion-ios-star"></i> </span>
                                    <span class="star-on"><i class="ion-ios-star"></i> </span>
                                    <span class="star-on"><i class="ion-ios-star"></i> </span>
                                    <span class="star-on de-selected"><i class="ion-ios-star"></i> </span>
                                </div>
                            </div>
                            <div class="product-body">
                                <span class="product-price text-center"> <span class="new-price">$29.00</span>
                                </span>
                                <p class="border-top pt-30">Whether you're exploring the woods or the city, the Brixton™
                                    Patrol All </p>
                                <ul>
                                    <li>Terrain Anorak Jacket has got you covered.</li>
                                    <li>Camo jacket crafted from 4.5 oz nylon ripstop with two-way stretch, and a
                                        water-repellent coating.</li>
                                    <li>Drawstring hood.</li>
                                </ul>
                            </div>
                            <div class="product-size d-flex align-items-center mt-30">
                                <h3 class="title">Dimension</h3>
                                <select>
                                    <option value="0">S</option>
                                    <option value="1">M</option>
                                    <option value="2">L</option>
                                    <option value="3">XL</option>

                                </select>
                            </div>
                            <div class="product-footer">
                                <div class="product-count style d-flex flex-column flex-sm-row my-4">
                                    <div class="count d-flex">
                                        <input type="number" min="1" max="10" step="1" value="1">
                                        <div class="button-group">
                                            <button class="count-btn increment"><i
                                                        class="fas fa-chevron-up"></i></button>
                                            <button class="count-btn decrement"><i
                                                        class="fas fa-chevron-down"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn theme-btn--dark3 btn--xl mt-30 mt-sm-0">
                                            <span class="me-2"><i class="ion-bag"></i></span>
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                                <div class="addto-whish-list">
                                    <a href="#"><i class="icon-heart"></i> Add to wishlist</a>
                                    <a href="#"><i class="icon-shuffle"></i> Add to compare</a>
                                </div>
                                <div class="pro-social-links mt-10">
                                    <ul class="d-flex align-items-center">
                                        <li class="share">Share</li>
                                        <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                        <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                        <li><a href="#"><i class="ion-social-google"></i></a></li>
                                        <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- second modal -->
<div class="modal fade style2" id="compare" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <h5 class="title"><i class="fa fa-check"></i> Product added to compare.</h5>
            </div>
        </div>
    </div>
</div>
<!-- second modal -->
<div class="modal fade style3" id="add-to-cart" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-basket" role="document">
    </div>
</div>
<!-- modals end -->



<!--***********************
    all js files
 ***********************-->

<!--******************************************************
    jquery,modernizr ,poppe,bootstrap,plugins and main js
 ******************************************************-->
{{--<script src="/js/jquery-3.2.1.min.js"></script>--}}
<script src="{{ asset('js/vendor/libs.js') }}"></script>
<script src="{{ asset('js/vendor/app.js') }}"></script>
@stack('scripts')

{{--<script src="{{ asset('js/vendor/jquery-3.6.0.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/modernizr-3.7.1.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/plugins/jquery-ui.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/plugins/plugins.js') }}" async></script>--}}
{{--<script src="{{ asset('js/main.js') }}" defer></script>--}}


<!-- Use the minified version files listed below for better performance and remove the files listed above -->

<!--***************************
      Minified  js
 ***************************-->

<!--***********************************
     vendor,plugins and main js
  ***********************************-->

<!-- <script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>
<script src="assets/js/main.js"></script> -->

</body>
