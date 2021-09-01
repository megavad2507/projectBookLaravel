@extends('admin.app')
@section('title','Просмотр заказа №'. $order->id)
@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class="panel">
                <h1>Заказ №{{ $order->id }}</h1>
                <p>Заказчик: <b>{{ $order->name }}</b></p>
                <p>Номер: <b>{{ $order->phone }}</b></p>
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
                    @foreach($order->products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('product',[$product->category->code,$product->code]) }}">
                                    <img height="56px" src="{{ Storage::url($product->picture) }}" alt="{{ $product->name }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td><span class="badge">{{ $product->pivot->quantity }}</span></td>
                            <td>{{ $product->pivot->price }} {{ $currencySymbol }}</td>
                            <td>{{ $product->getOrderPrice() }} {{ $order->currency->symbol }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Общая стоимость:</td>
                        <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
