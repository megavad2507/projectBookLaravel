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
                                <img src="
                                @if(Storage::exists($sku->product->picture))
                                    {{ Storage::url($sku->product->picture) }}
                                @else
                                    {{ Storage::url('no_photo.jpeg') }}
                                @endif
                                    "
                                     alt="{{ $sku->product->__('name') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-md-0">
                    <div class="single-product-info">
                        <div class="single-product-head">
                            <h2 class="title mb-20">{{ $sku->product->__('name') }}</h2>
                        </div>
                        <div class="star-content mb-20">
                            @for($i = 0; $i < (int)$sku->reviews()->getActive()->avg('grade');$i++)
                                <span class="star-on"><i class="ion-ios-star"></i> </span>
                            @endfor
                            <a href="#reviews_block" id="write-comment"
                            ><span class="ms-2"><i class="far fa-comment-dots"></i></span>
                                Прочитать отзывы <span>{{ $sku->reviews()->getActive()->count() }}</span></a
                            >
                            <a href="#review_add_form" id="review_add_button_top"
                            ><span class="edite"><i class="far fa-edit"></i></span> Написать отзыв</a
                            >
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
    <div class="product-tab theme1 bg-white pt-70 pb-70">
        <div class="container">
            <div class="product-tab-nav">
                <div class="row align-items-center">
                    <div class="col-12">
                        <nav class="product-tab-menu single-product">
                            <ul
                                class="nav nav-pills justify-content-center"
                                id="pills-tab"
                                role="tablist"
                            >
                                <li class="nav-item">
                                    <a
                                        class="nav-link active"
                                        id="pills-contact-tab"
                                        data-bs-toggle="pill"
                                        href="#pills-contact"
                                        role="tab"
                                        aria-controls="pills-contact"
                                        aria-selected="false"
                                    >@lang('main.reviews')</a
                                    >
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- product-tab-nav end -->
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="pills-contact"
                            role="tabpanel"
                            aria-labelledby="pills-contact-tab"
                        >
                            <div class="single-product-desc" id="reviews_block">
                                @foreach($sku->reviews()->getActive()->orderBy('created_at','asc')->get() as $review)
                                    <div class="grade-content">
                                        <span class="grade">@lang('main.grade') </span>
                                        @for($i = 0; $i < $review->grade;$i++)
                                            <span class="star-on"><i class="ion-ios-star"></i> </span>

                                        @endfor
                                        <h6 class="sub-title">{{ $review->authour_name }}</h6>
                                        <p>{{ Carbon\Carbon::createFromDate($review->created_at)->format('d.m.y') }}</p>
                                        <p>{{ $review->text }}</p>
                                        @if(!empty($review->photos))
                                            @foreach($review->photos as $photo)
                                                <img src="{{ Storage::url($photo) }}" alt="" style="max-width: 300px;max-height: 300px;">
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                                <a
                                    class="btn theme-btn--dark3 theme-btn--dark3-sm btn--sm rounded-5 mt-15"
                                    id="button_add_review"
                                >@lang('main.write_review')</a
                                >
                                @include('layouts.review_add_form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
