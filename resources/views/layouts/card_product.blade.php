<div class="product">
    <div class="product_image"><img src="{{ Storage::url($product->picture) }}" alt="{{ $product->__('name') }}"></div>
    @include('layouts.product_labels')
    <div class="product_content">
        <form action="{{ route('basketAdd',$product) }}" method="POST">
            @csrf
            <div class="product_title">
                <a href="{{ route('product',[isset($category) ? $category->code : $product->category->code,$product->code]) }}">
                    {{ $product->__('name') }}
                    @if(!is_null($product->skus_properties))
                        @foreach($product->skus_properties as $option)
                            <h4>{{ $option[__('name')] }}: {{ implode(", ",array_column($option['values'],__('name'))) }}</h4>
                        @endforeach
                    @endif
{{--                    @if(!is_null($product->properties) && isset($product->properties))--}}
{{--                        @foreach($propertyOptions as $i => $propertyOption)--}}
{{--                            <h4>{{ $product->properties[$i]->__('name') }}: {{ $propertyOption->__('name') }}</h4>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
                </a>
            </div>
            <div class="product_price">
                @if($product->min_price == $product->max_price)
                    {{ $product->min_price }}
                @else
                    {{ $product->min_price }} - {{ $product->max_price }}
                @endif
                {{ $currencySymbol }}
            </div>

{{--            <div class="add_to_basket">--}}
{{--                <button type="submit" @if(!$isAvailable()) title="Товар не доступен для покупки" disabled @endif>--}}
{{--                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
        </form>
    </div>
</div>
