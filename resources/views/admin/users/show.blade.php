@extends('admin.app')
@section('title','Пользователь '.$user->name)
@section('content')
    <h1>Вариант свойства {{ $user->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Администратор</td>
                <td>{{ $user->is_admin === 1 ? 'Да' : 'Нет' }}</td>
            </tr>
        </thead>
    </table>
    <a href="{{ route('users.index') }}">Назад</a>
@endsection
