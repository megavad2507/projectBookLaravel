<!-- new arrival section start -->
<section class="theme1 bg-white pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize mb-20">@lang('new_products.title') </h2>
                    <p class="text">@lang('new_products.description')</p>
                </div>
            </div>
            <div class="col-12">
                <div class="product-slider-init products-slider slick-nav">
                    @foreach($newProducts as $product)
                        <!-- slider-item start -->
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail w-100 position-relative">
{{--                                            <span class="badge badge-danger top-left">new</span>--}}
                                            @include('layouts.product_labels')
                                            <a class="d-block" href="{{ route('product',[isset($category) ? $category->code : $product->category->code,$product->code]) }}">
                                                <img class="first-img" src="{{ Storage::url($product->picture) }}" alt="{{ $product->__('name') }}">
                                            </a>
                                            <!-- product links -->

                                            <div class="product-links d-flex d-flex justify-content-between">
                                                <button class="pro-btn" data-product-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#add-to-cart">@lang('main.add_to_basket')</button>
                                            </div>

                                        </div>
                                        <div class="media-body">
                                            <div class="product-desc">
                                                <h3 class="title my-10"><a href="{{ route('sku',[isset($category) ? $category->code : $product->category->code,$product->code,$product->skus->first()->id]) }}">
                                                        {{ $product->__('name') }}</a></h3>
                                                <h6 class="product-price">
                                                    <span class="onsale">@include('layouts.prices',compact('product'))</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- new arrival section end -->
