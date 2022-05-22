@extends('admin.app')
@section('title','Просмотр способа оплаты '.$payment->name)
@section('content')
    <h1>Способ оплаты {{ $payment->name }}</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Поле</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>Название</td>
            <td>{{ $payment->name }}</td>
        </tr>
        <tr>
            <td>Название на английском</td>
            <td>{{ $payment->name_en }}</td>
        </tr>
        <tr>
            <td>Описание</td>
            <td>{{ $payment->description }}</td>
        </tr>
        <tr>
            <td>Описание на английском</td>
            <td>{{ $payment->description_en }}</td>
        </tr>
        <tr>
            <td>ID</td>
            <td>{{ $payment->id }}</td>
        </tr>

        </thead>
    </table>
@endsection
