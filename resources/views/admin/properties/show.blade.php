@extends('admin.app')
@section('title','Просмотр свойства '.$property->name)
@section('content')
    <h1>Свойство {{ $property->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $property->id }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $property->name }}</td>
            </tr>
            <tr>
                <td>Название на английском</td>
                <td>{{ $property->name_en }}</td>
            </tr>
        </thead>
    </table>
@endsection
