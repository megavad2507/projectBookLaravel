@if($product->min_price != $product->max_price)
    {{ $product->min_price }} - {{ $product->max_price }}
@else
    {{ $product->min_price }}
@endif
{{ $currencySymbol }}
