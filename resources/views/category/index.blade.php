@extends('layouts.main_layout')
@section('title',$category->__('name'))
@section('content')
    {{ Breadcrumbs::render('category',$category) }}
    <!-- product tab start -->
    <div class="product-tab pb-40">
        <div class="container grid-wraper">
            <div class="row">
                <div class="col-lg-9 mb-30">
                    <div class="grid-nav-wraper mb-30">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <nav class="shop-grid-nav">
                                    <ul class="nav nav-pills align-items-center" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                                               role="tab" aria-controls="pills-home" aria-selected="true">
                                                <i class="fa fa-th"></i>

                                            </a>
                                        </li>
                                        <li class="nav-item me-0">
                                            <a class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile"
                                               role="tab" aria-controls="pills-profile" aria-selected="false"><i
                                                    class="fa fa-list"></i></a>
                                        </li>
                                        <li> <span class="total-products text-capitalize">@lang('main.all_product_quantity',['quantity'=> $products->total()])</span></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- product-tab-nav end -->
                    <div class="tab-content" id="pills-tabContent">
                        <!-- first tab-pane -->
                        <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row grid-view theme1">
                                @if($products->count() > 0)
                                    @foreach($products as $product)
                                        @include('layouts.card_grid',compact('product'))
                                    @endforeach
                                @else
                                    @lang('main.no_filter_products')
                                @endif
                            </div>
                        </div>
                        <!-- second tab-pane -->
                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row grid-view-list theme1">
                                @if($products->count() > 0)
                                    @foreach($products as $product)
                                        @include('layouts.card_list',compact('product'))
                                    @endforeach
                                @else
                                    @lang('main.no_filter_products')
                                @endif
                            </div>
                        </div>
                    </div>
                    {{ $products->appends([ 'price_from' => request()->price_from, 'price_to' => request()->price_to, 'hit' => request()->hit, 'new' => request()->new, 'recommend' => request()->recommend])->links('layouts.pagination',['category' => $category]) }}
                </div>
                <div class="col-lg-3 mb-30 order-lg-first">
                    <aside class="left-sidebar theme1">
                        <!-- search-filter start -->
                        <div class="search-filter">
                            <div class="check-box-inner pt-0">
                                <h4 class="title">{{ $category->__('name') }}</h4>
                            </div>

                        </div>

                        <ul id="offcanvas-menu2" class="blog-ctry-menu">
                            @foreach($categories as $categ)
                                <li @if($categ->id == $category->id) class="active"@endif>
                                    <a href="{{ route('category',$categ->code) }}">{{ $categ->__('name') }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="search-filter border-top mt-45 pt-45">
                            <form action="/{{ Request::path() }}" method="GET" id="product-filter">
                                <!-- check-box-inner -->
                                <div class="check-box-inner mt-10">
                                    <h4 class="sub-title">@lang('main.filter_price')</h4>
                                    <div class="price-filter mt-10">
                                        <div class="price-slider-amount">
                                            <input name="price_from" type="text" id="price_from" class="price_input"
                                                   placeholder="@lang('main.properties.price_from')" value="{{ request()->price_from }}"/>
                                        </div>
                                    </div>
                                    <div class="price-filter mt-10">
                                        <div class="price-slider-amount">
                                            <input name="price_to" type="text" id="price_to" class="price_input"
                                                   placeholder="@lang('main.properties.price_to')" value="{{ request()->price_to }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="check-box-inner mt-10">
                                    <h4 class="sub-title">@lang('main.properties.main_title')</h4>
                                    @foreach(['hot' => __('main.properties.hot'),'new' => __('main.properties.new'),'sale' => __('main.properties.sale')] as $attribute => $name)
                                        <div class="filter-check-box">
                                            <input type="checkbox" name="{{ $attribute }}" id="filter_{{ $attribute }}" @if(request()->has($attribute)) checked @endif>
                                            <label for="filter_{{ $attribute }}">{{ $name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @foreach($properties as $property)
                                    <div class="check-box-inner mt-10">
                                        <h4 class="sub-title">{{ $property->__('name') }}</h4>
                                        <input type="hidden" name="{{ $property->code }}[]">
                                        @foreach($property->options as $option)
                                            <div class="filter-check-box">
                                                @php
                                                    $checked = false;
                                                    if(request()->filled($property->code) && array_key_exists($property->code,$filterValues)) {
                                                        if(in_array($option->code,$filterValues[$property->code])) {
                                                            $checked = true;
                                                        }
                                                    }
                                                @endphp
                                                <input type="checkbox" filter-name="{{ $property->code }}" id="filter_{{ $property->code }}_{{ $option->code }}" filter-value="{{ $option->code }}" @if($checked) checked @endif>
                                                <label for="filter_{{ $property->code }}_{{ $option->code }}">{{ $option->__('name') }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    <button class="theme--btn1 btn--md button-filter" type="submit">@lang('main.filter_find')</button>
                                </div>
                            </form>
                        </div>
                        <!-- search-filter end -->
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- product tab end -->
@endsection
