<div class="col-sm-6 col-md-4 mb-30">
    <div class="card product-card">
        <div class="card-body p-0">
            <div class="product-thumbnail position-relative">
                @include('layouts.product_labels')
                <a
                    @if($product->skus->count() > 0)
                        href="{{ route('sku',[isset($category) ? $category->code : $product->category->code,$product->code,$product->skus->first()->id]) }}"
                    @else
                        href="{{ route('product',[isset($category) ? $category->code : $product->category->code,$product->code]) }}"
                    @endif
                >
                    <img class="first-img"
                        src="
                                @if(Storage::exists($product->picture))
                                    {{ Storage::url($product->picture) }}
                                @else
                                    {{ Storage::url('no_photo.jpeg') }}
                                @endif
                                    "
                         alt="{{ $product->__('name') }}">
                </a>
                <!-- product links -->
                <div class="product-links d-flex d-flex justify-content-between">
                    @include('layouts.buy_button')
                    <!-- product links end-->
                </div>
                <!-- product links end-->
            </div>
            <div class="product-desc">
                <h3 class="title">
                    <a
                        @if($product->skus->count() > 0)
                            href="{{ route('sku',[isset($category) ? $category->code : $product->category->code,$product->code,$product->skus->first()->id]) }}"
                        @else
                            href="{{ route('product',[isset($category) ? $category->code : $product->category->code,$product->code]) }}"
                        @endif
                    >
                        {{ $product->__('name') }}.
                    </a>
                </h3>
                <h6 class="product-price">@include('layouts.prices',compact('product'))</h6>
            </div>
        </div>
    </div>
    <!-- product-list End -->
</div>
