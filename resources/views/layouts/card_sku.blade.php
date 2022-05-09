<div class="card product-card">
    <div class="card-body p-0">
        <div class="media flex-column">
            <div class="product-thumbnail w-100 position-relative">
                @include('layouts.product_labels')
                <a class="d-block" href="{{ route('sku',[isset($category) ? $category->code : $product->category->code,$product->code,$product->skus->first()->id]) }}">
                    <img class="first-img" src="{{ Storage::url($product->picture) }}" alt="{{ $product->__('name') }}">
                </a>
                <!-- product links -->

                <div class="product-links d-flex d-flex justify-content-between">
                    <button class="pro-btn basket-add" data-product-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#add-to-cart" type="submit">@lang('main.add_to_basket')</button>
                </div>

            </div>
            <div class="media-body">
                <div class="product-desc">
                    <h3 class="title my-10"><a href="{{ route('sku',[isset($category) ? $category->code : $product->category->code,$product->code,$product->skus->first()->id]) }}">
                            {{ $product->__('name') }}</a></h3>
                    <h6 class="product-price">
                        <span class="onsale">
                            @include('layouts.prices',compact('product'))
                        </span></h6>
                </div>
            </div>
        </div>
    </div>
</div>
