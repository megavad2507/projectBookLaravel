@extends('layouts.main_layout')
@section('content')
    @include('layouts.banners')


    <!-- staic media start -->
    <section class="static-media-section bg-white pt-70 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-30">
                    <div class="d-flex static-media2 flex-column">
                        <img class="align-self-center mb-20" src="{{ asset('img/icon/2.png') }}" alt="icon">
                        <div class="media-body text-center">
                            <h4 class="title text-uppercase text-dark mb-25">Free Shipping Worldwide</h4>
                            <p class="text">Mirum est notare quam littera gothica, quam nunc putamus parum claram</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-30">
                    <div class="d-flex static-media2 flex-column">
                        <img class="align-self-center mb-20" src="{{ asset('img/icon/3.png') }}" alt="icon">
                        <div class="media-body text-center">
                            <h4 class="title text-uppercase text-dark mb-25">Money Back Guarantee</h4>
                            <p class="text">Mirum est notare quam littera gothica, quam nunc putamus parum claram</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-30">
                    <div class="d-flex static-media2 flex-column">
                        <img class="align-self-center mb-20" src="{{ asset('img/icon/4.png') }}" alt="icon">
                        <div class="media-body text-center">
                            <h4 class="title text-uppercase text-dark mb-25">Support 24/7</h4>
                            <p class="text">Mirum est notare quam littera gothica, quam nunc putamus parum claram</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- staic media end -->

    <!-- new arrival section start -->
    <section class="popular-slider2 theme1 bg-light2 px-xl-4 pt-70 pt-xl-0 mb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 d-xl-flex align-items-xl-center">
                    <div class="section-title text-center text-xl-start pb-30">
                        <hr class="hr d-none d-xl-block">
                        <h2 class="title text-dark text-capitalize mb-20">Recommended <span class="d-xl-block">For
                                You</span> </h2>
                        <p class="text">Shop for home decor at Purus for less. From decorative pillows, curtains, and
                            lighting. Free shipping on orders over $35 and free store pickup. </p>
                    </div>
                </div>
                <div class="col-xl-10">
                    <div class="popular-slider-init2 products-slider slick-nav">
                        @foreach($products as $product)
                            <div class="slider-item">
                                @include('layouts.card_sku',compact('product'))
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- new arrival section end -->
    @include('layouts.new_products')

    <!-- common-banner start -->
    <div class="common-banner pb-70 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="position-relative zoom-in overflow-hidden">
                        <div class="banner-thumb banner-lagre">
                            <img src="{{ asset('img/banner/3.jpg') }}" alt="banner-thumb-naile">
                        </div>
                        <div class="banner-content banner-content-large">
                            <p class="text text-uppercase text-dark mb-10">Black Friday</p>
                            <h4 class="title text-capitalize text-dark">Save Up To
                                <span class="d-block d-inline-sm-block mt-10 mt-md-20">50% Off</span> </h4>
                            <a class="view-link text-capitalize mt-25" href="shop-grid-4-column.html">View
                                collection
                                <span class="ion-android-arrow-dropright-circle theme-color"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- common-banner end -->
@endsection
