@extends('admin.app')
@section('title','Просмотр поставщика '.$merchant->name)
@section('content')
    <h1>Поставщик {{ $merchant->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $merchant->id }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $merchant->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $merchant->email }}</td>
            </tr>
        </thead>
    </table>
@endsection
