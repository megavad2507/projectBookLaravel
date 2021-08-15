@extends('admin.app')
@section('title','Изменить товар '.$product->name)
@section('content')
    <h1>Категория {{ $product->name }}</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Поле</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>ID</td>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <td>Код</td>
            <td>{{ $product->code }}</td>
        </tr>
        <tr>
            <td>Название</td>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <td>Цена</td>
            <td>{{ $product->price }}</td>
        </tr>
        <tr>
            <td>Категория</td>
            <td>{{ $product->category->name }}</td>
        </tr>
        <tr>
            <td>Описание</td>
            <td>{{ $product->description }}</td>
        </tr>
        @isset($product->picture)
            <tr>
                <td>Картинка</td>
                <td><img src="{{ Storage::url($product->picture) }}" alt="{{ $product->name }}" height="240px"></td>
            </tr>
        @endisset
        </thead>
    </table>
@endsection
