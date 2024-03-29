<?php $banners = \App\Models\Banner::get();?>
<!-- main slider start -->
<section class="bg-light position-relative">

    <div class="main-slider dots-style theme1">
        @foreach($banners as $banner)
            <!-- slider-item start -->
            <div class="slider-item bg-img" style="background-image: url('{{ Storage::url($banner->picture) }}')">
                <div class="container">
                    <div class="row align-items-center slider-height2">
                        <div class="col-12">
                            <div class="slider-content">
{{--                                <p class="text text-dark text-uppercase animated mb-25" data-animation-in="fadeInDown">--}}
{{--                                    cleanse and refresh</p>--}}
                                <h4 class="title animated mb-20" data-animation-in="fadeInLeft"
                                    data-delay-in="1" @if($banner->hex) style="color:{{ $banner->hex }}" @endif>{{ $banner->__('description') }}</h4>
                                <h2 class="sub-title animated" data-animation-in="fadeInRight" data-delay-in="2" @if($banner->hex) style="color:{{ $banner->hex }}" @endif>
                                    {{ $banner->__('title') }}</h2>
                                <a href="{{ $banner->button_href }}"
                                   class="btn theme--btn1 btn--lg text-uppercase  animated mt-45 mt-sm-25"
                                   data-animation-in="zoomIn" data-delay-in="3">{{ $banner->__('button_text') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- slider-item end -->
    </div>
    <!-- slick-progress -->
    <div class="slick-progress">
        <span></span>
    </div>
    <!-- slick-progress end-->
</section>
<!-- main slider end -->
