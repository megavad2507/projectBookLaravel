@extends('admin.app')
@section('title','Просмотр купона '.$coupon->code)
@section('content')
    <h1>Купон {{ $coupon->code }}</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Поле</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>ID</td>
            <td>{{ $coupon->id }}</td>
        </tr>
        <tr>
            <td>Код</td>
            <td>{{ $coupon->code }}</td>
        </tr>
        <tr>
            <td>Описание</td>
            <td>{{ $coupon->description }}</td>
        </tr>
        <tr>
            <td>Скидка</td>
            <td>{{ $coupon->value }} @if($coupon->isAbsolute()) {{ $coupon->currency->symbol }} @else % @endif</td>
        </tr>
        @isset($coupon->currency)
            <tr>
                <td>Валюта</td>
                <td>{{ $coupon->currency->code }}</td>
            </tr>
        @endif
        <tr>
            <td>Абсолютное значение</td>
            <td>@if($coupon->isAbsolute()) Да @else Нет @endif</td>
        </tr>
        <tr>
            <td>Повторное использование</td>
            <td>@if(!$coupon->isOnlyOnce()) Да @else Нет @endif</td>
        </tr>
        <tr>
            <td>Использован</td>
            <td>{{ $coupon->orders->count() }} раз</td>
        </tr>
        <tr>
            <td>Дейсвтителен до:</td>
            <td>{{ isset($coupon->expired_at) ? $coupon->expired_at->format('d.m.Y') : 'Бессрочно'  }}</td>
        </tr>
        </thead>
    </table>
@endsection
