@extends('admin.app')
@section('title','Просмотр варианта свойства '.$property->name)
@section('content')
    <h1>Вариант свойства {{ $property->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $propertyOption->id }}</td>
            </tr>
            <tr>
                <td>ID свойства</td>
                <td>{{ $property->id }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $propertyOption->name }}</td>
            </tr>
            <tr>
                <td>Название на английском</td>
                <td>{{ $propertyOption->name_en }}</td>
            </tr>
        </thead>
    </table>
    <a href="{{ route('property_options.index',[$property]) }}">Назад</a>
@endsection
