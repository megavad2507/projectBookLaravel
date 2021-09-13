<div class="product">
    <div class="product_image"><img src="{{ Storage::url($sku->product->picture) }}" alt="{{ $sku->product->__('name') }}"></div>
    @include('layouts.product_labels')
    <div class="product_content">
        <form action="{{ route('basketAdd',$sku) }}" method="POST">
            @csrf
            <div class="product_title">
                <a href="{{ route('sku',[isset($category) ? $category->code : $sku->product->category->code,$sku->product->code,$sku]) }}">
                    {{ $sku->product->__('name') }}
                    @if(!is_null($sku->product->properties) && isset($sku->product->properties))
                        @foreach($sku->propertyOptions as $propertyOption)
                            <h4>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h4>
                        @endforeach
                    @endif
                </a>
            </div>

            <div class="add_to_basket">
                <button type="submit" @if(!$sku->isAvailable()) title="Товар не доступен для покупки" disabled @endif>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </button>
            </div>
            <div class="product_price">{{ $sku->price }} {{ $currencySymbol }}</div>
        </form>
    </div>
</div>
