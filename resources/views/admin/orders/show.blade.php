@extends('admin.app')
@section('title','Просмотр заказа №'. $order->id)
@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class="panel">
                <h1>Заказ №{{ $order->id }}</h1>
                <p>Заказчик: <b>{{ $order->name }}</b></p>
                <p>Email: <b>{{ $order->email }}</b></p>
                <p>Номер: <b>{{ $order->phone }}</b></p>
                <p>Способ оплаты: <b>{{ $order->payment->__('name') }}</b></p>
                <p>Адрес доставки: <b>{{ $order->address_delivery }}</b></p>
                <table class="table table-stripped">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Стоимость</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->skus as $sku)
                        <tr>
                            <td>
                                <a href="{{ route('sku',[$sku->product->category->code,$sku->product->code,$sku]) }}">
                                    <img height="56px" src="
                                        @if(Storage::exists($sku->product->picture))
                                            {{ Storage::url($sku->product->picture) }}
                                        @else
                                            {{ Storage::url('no_photo.jpeg') }}
                                        @endif
                                            "
                                         alt="{{ $sku->product->__('name') }}">
                                    {{ $sku->product->__('name') }}
                                    @isset($sku->product->properties)
                                        @foreach($sku->propertyOptions as $propertyOption)
                                            <span>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</span>
                                        @endforeach
                                    @endisset
                                </a>
                            </td>
                            <td><span class="badge">{{ $sku->pivot->quantity }}</span></td>
                            <td>{{ $sku->pivot->price }} {{ $currencySymbol }}</td>
                            <td>{{ $sku->getOrderPrice() }} {{ $order->currency->symbol }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Общая стоимость:</td>
                        <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                    </tr>
                    @if($order->hasCoupon())
                        <tr>
                            <td colspan="2">Был использован купон</td>
                            <td>{{ $order->coupon->code}}</td>
                            <td>{{ $order->coupon->description }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
