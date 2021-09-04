@extends('admin.app')
@section('title', $product->name . ' ' . $sku->propertyOptions->map->name->implode(', '))
@section('content')
    <h1>{{ $product->name . ' ' . $sku->propertyOptions->map->name->implode(', ') }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $sku->id }}</td>
            </tr>
            <tr>
                <td>Цена</td>
                <td>{{ $sku->price }}</td>
            </tr>
            <tr>
                <td>Количество</td>
                <td>{{ $sku->quantity }}</td>
            </tr>
        </thead>
    </table>
    <a href="{{ route('skus.index',$product) }}">Назад</a>
@endsection
