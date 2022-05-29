<p>Уважаемый {{ $name ? $name : 'клиент' }}, товар
    <b>
        {{ $sku->product->__('name') }}
        @isset($sku->product->properties)
            @foreach($sku->propertyOptions as $propertyOption)
                <span>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</span>
            @endforeach
        @endisset
    </b> появился в наличии. Было добавлено всего {{ $sku->quantity }} штук, поторопитесь!</p>

<p><a href="{{ route('sku',[$sku->product->category->code,$sku->product->code,$sku]) }}">Посмотреть товар</a></p>
