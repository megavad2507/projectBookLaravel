@extends('layouts.main_layout')
@section('content')
    {{ Breadcrumbs::render('product',$product->category,$sku->product,$sku) }}
    <!-- product-single start -->
    @include('layouts.preloader')
    <section class="product-single theme1">
        <div class="container grid-wraper">
            <div class="row">
                <div class="col-md-9 mx-auto col-lg-6 mb-5 mb-lg-0">
                    @php
                        $isDetail = true;
                    @endphp
                    @include('layouts.product_labels',compact('isDetail'))
                    <div class="product-sync-init mb-30">
                        <div class="single-product">
                            <div class="product-thumb">
                                <img src="{{ Storage::url($sku->product->picture) }}" alt="{{ $sku->product->__('name') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-md-0">
                    <div class="single-product-info">
                        <div class="single-product-head">
                            <h2 class="title mb-20">{{ $sku->product->__('name') }}</h2>
                        </div>
                        <div class="product-body mb-40">
                            <div class="product-prices">
                                <div class="product-price h5">
                                    <div class="current-price">
                                        <span class="value">{{ $sku->price }}</span> <span class="currency">{{ $currencySymbol }}</span>
                                    </div>
                                </div>
                            </div>
                            <p class="font-size">{{ $sku->product->description }}</p>
                        </div>
                        <div class="product-footer" id="product-footer">
                            @include('layouts.product_footer')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-single end -->
@endsection
