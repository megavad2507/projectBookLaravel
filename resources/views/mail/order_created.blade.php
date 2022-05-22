<p>Дорогой(ая) {{ $name }}, Ваш заказ №{{ $order->id }} создан</p>
<p>Выбранный способ оплаты: {{ $order->payment->name }}</p>
<p>Заказ будет доставлен по адресу: {{ $order->address_delivery }}</p>
<table>
    <thead>
        <tr>
            <th>Картинка</th>
            <th>Имя</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Полная стоимость</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->skus as $sku)
            <tr>
                <td>
                    <a href="{{ route('sku',[$sku->product->category->code,$sku->product->code,$sku]) }}">
                        <img src="
                                @if(Storage::exists($sku->product->picture))
                                    {{ Storage::url($sku->product->picture) }}
                                @else
                                    {{ Storage::url('no_photo.jpeg') }}
                                @endif
                                    "
                             alt="{{ $sku->product->__('name') }}" width="60px" height="60px">
                    </a>
                </td>
                <td>
                    <a href="{{ route('sku',[$sku->product->category->code,$sku->product->code,$sku]) }}">
                        {{ $sku->product->__('name') }}
                        @isset($sku->product->properties)
                            @foreach($sku->propertyOptions as $propertyOption)
                                <span>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</span>
                            @endforeach
                        @endisset
                    </a>
                </td>
                <td>{{ $sku->price }}</td>
                <td>{{ $sku->quantityInOrder }}</td>
                <td>{{ $sku->getAmountPrice() }} {{ $currencySymbol }}</td>
            </tr>
        @endforeach
        <th colspan="5" align="right">Конечная цена {{ $fullSum }} {{ $currencySymbol }}</th>
    </tbody>
</table>
