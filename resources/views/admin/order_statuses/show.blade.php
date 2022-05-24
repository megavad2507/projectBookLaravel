@extends('admin.app')
@section('title','Просмотр способа оплаты '.$orderStatus->name)
@section('content')
    <h1>Способ оплаты {{ $orderStatus->name }}</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Поле</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>ID</td>
            <td>{{ $orderStatus->id }}</td>
        </tr>
        <tr>
            <td>Название</td>
            <td>{{ $orderStatus->name }}</td>
        </tr>
        <tr>
            <td>Сортировка</td>
            <td>{{ $orderStatus->sort }}</td>
        </tr>
        <tr>
            <td>Название на английском</td>
            <td>{{ $orderStatus->name_en }}</td>
        </tr>
        <tr>
            <td>Описание</td>
            <td>{{ $orderStatus->description }}</td>
        </tr>
        <tr>
            <td>Описание на английском</td>
            <td>{{ $orderStatus->description_en }}</td>
        </tr>

        </thead>
    </table>
@endsection
